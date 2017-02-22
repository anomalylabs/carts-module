<?php namespace Anomaly\CartsModule\Cart;

use Anomaly\CartsModule\Cart\Command\ApplyVariants;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\ItemCollection;
use Anomaly\Streams\Platform\Model\Carts\CartsCartsEntryModel;

/**
 * Class CartModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart
 */
class CartModel extends CartsCartsEntryModel implements CartInterface
{

    /**
     * Return the total.
     *
     * @return float
     */
    public function subtotal()
    {
        $items = $this->getItems();

        return $items->subtotal();
    }

    /**
     * Return the tax.
     *
     * @return float
     */
    public function tax()
    {
        $items = $this->getItems();

        return $items->tax();
    }

    /**
     * Return the total discounts.
     *
     * @return float
     */
    public function discounts()
    {
        $items = $this->getItems();

        return $items->discounts();
    }

    /**
     * Return the total.
     *
     * @return float
     */
    public function total()
    {
        $items = $this->getItems();

        return $items->total();
    }

    /**
     * Apply the item variants.
     *
     * @return $this;
     */
    public function applyVariants()
    {
        $this->dispatch(new ApplyVariants($this->getItems()));

        return $this;
    }

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId()
    {
        return $this->str_id;
    }

    /**
     * Get related items.
     *
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Return the items relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('Anomaly\CartsModule\Item\ItemModel', 'cart_id');
    }
}
