<?php namespace Anomaly\CartsModule\Cart\Listener;

use Anomaly\CartsModule\Cart\Cart;
use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddToCart
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddToCart
{

    use DispatchesJobs;

    /**
     * The item repository.
     *
     * @var ItemRepositoryInterface
     */
    protected $items;

    /**
     * Create a new AddToCart instance.
     *
     * @param ItemRepositoryInterface $items
     */
    public function __construct(ItemRepositoryInterface $items)
    {
        $this->items = $items;
    }

    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle(EntryInterface $entry, $quantity = 1)
    {
        if (!$entry->isPurchasable()) {
            return;
        }

        /* @var CartInterface $cart */
        $cart = $this->dispatch(new GetCart('default'));

        $items = $cart->getItems();

        /* @var ItemInterface|EloquentModel $item */
        if ($item = $items->findBy('sku', $entry->getPurchasableSku())) {

            $item->setAttribute('quantity', $item->getQuantity() + $quantity);

            $this->items->save($item);

            return;
        }

        $this->items->create(
            [
                'price'    => $entry->getPurchasablePrice(),
                'name'     => $entry->getPurchasableName(),
                'sku'      => $entry->getPurchasableSku(),
                'quantity' => $quantity,
                'product'  => $entry,
                'cart'     => $cart,
            ]
        );
    }
}
