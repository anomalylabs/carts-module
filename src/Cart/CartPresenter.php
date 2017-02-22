<?php namespace Anomaly\CartsModule\Cart;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\ItemCollection;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Illuminate\Session\Store;

/**
 * Class CartPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart
 */
class CartPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     *
     * @var CartInterface
     */
    protected $object;

    /**
     * The session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * Return the quantity of items in the cart.
     *
     * @return int
     */
    public function total()
    {
        /* @var ItemCollection $items */
        $items = $this->object->getItems();

        return $items->total();
    }

    /**
     * Return the quantity of items in the cart.
     *
     * @return int
     */
    public function quantity()
    {
        /* @var ItemCollection $items */
        $items = $this->object->getItems();

        return $items->quantity();
    }

    /**
     * Return the status of the cart.
     *
     * @return string
     */
    public function status()
    {
        $date = $this->object->lastModified();

        if ($date->diffInMinutes() < 15) {
            return 'active';
        }

        if ($date->diffInMinutes() < 60) {
            return 'stale';
        }

        return 'abandoned';
    }

    /**
     * Return the status label.
     *
     * @param string $size
     * @return string
     */
    public function statusLabel($size = 'sm')
    {
        switch ($this->status()) {
            case 'active':
                return $this->label('anomaly.module.carts::status.active', 'success', $size);
                break;

            case 'stale':
                return $this->label('anomaly.module.carts::status.stale', 'warning', $size);
                break;

            case 'abandoned':
                return $this->label('anomaly.module.carts::status.abandoned', 'default', $size);
                break;
        }

        return $this->label('anomaly.module.cart::status.abandoned', 'secondary', $size);
    }
}
