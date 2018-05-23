<?php namespace Anomaly\CartsModule\Item;

use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class ItemCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Item
 */
class ItemCollection extends EntryCollection
{

    /**
     * Return the tax.
     *
     * @return float
     */
    public function tax()
    {
        return $this->sum(
            function ($item) {

                /* @var ItemInterface $item */
                return $item->getTax();
            }
        );
    }

    /**
     * Return the total.
     *
     * @return float
     */
    public function total()
    {
        return $this->sum(
            function ($item) {

                /* @var ItemInterface $item */
                return $item->getTotal();
            }
        );
    }

    /**
     * Return the subtotal.
     *
     * @return float
     */
    public function subtotal()
    {
        return $this->sum(
            function ($item) {

                /* @var ItemInterface $item */
                return $item->getSubtotal();
            }
        );
    }

    /**
     * Return the total quantity.
     *
     * @return int
     */
    public function quantity()
    {
        return $this->sum(
            function ($item) {

                /* @var ItemInterface $item */
                return $item->getQuantity();
            }
        );
    }

    /**
     * Return the total discounts.
     *
     * @return float
     */
    public function discounts()
    {
        return $this->sum(
            function ($item) {

                /* @var ItemInterface $item */
                return $item->getDiscounts();
            }
        );
    }

    /**
     * Return the total shipping.
     *
     * @return float
     */
    public function shipping()
    {
        return $this->sum(
            function ($item) {

                /* @var ItemInterface $item */
                return $item->getShipping();
            }
        );
    }

    /**
     * Return the total calculations.
     *
     * @return float
     */
    public function adjustments($type)
    {
        return $this->sum(
            function ($item) use ($type) {

                /* @var ItemInterface $item */
                return $item->calculate($type);
            }
        );
    }
}
