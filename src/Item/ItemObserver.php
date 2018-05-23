<?php namespace Anomaly\CartsModule\Item;

use Anomaly\CartsModule\Cart\Command\ProcessCart;
use Anomaly\CartsModule\Cart\Command\TotalCart;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Command\TotalItem;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class ItemObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemObserver extends EntryObserver
{

    /**
     * Before saving an entry touch the
     * meta information.
     *
     * @param  EntryInterface|ItemInterface $entry
     */
    public function saving(EntryInterface $entry)
    {
        $this->dispatch(new TotalItem($entry));

        parent::saving($entry);
    }

    /**
     * Run after saving a record.
     *
     * @param EntryInterface|ItemInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        /* @var CartInterface|EloquentModel $cart */
        $cart = $entry->getCart();

        $cart->load('items');

        $this->dispatch(new ProcessCart($cart));

        $cart->load('items');
        $cart->load('modifiers');

        $this->dispatch(new TotalCart($cart));

        $cart->save();

        parent::saved($entry);
    }

    /**
     * Run after a record has been deleted.
     *
     * @param EntryInterface|ItemInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        /* @var CartInterface|EloquentModel $cart */
        $cart = $entry->getCart();

        $this->dispatch(new ProcessCart($cart));
        $this->dispatch(new TotalCart($cart));

        $cart->save();
    }

}
