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
     * Return the total price.
     *
     * @return float
     */
    public function total()
    {
        $discounts = $this->discounts();
        $subtotal  = $this->subtotal();

        return $subtotal - $discounts;
    }

    /**
     * Return the total discounts.
     *
     * @return float
     */
    public function discounts()
    {
        return 0.00;
    }

    /**
     * Return the sub total.
     *
     * @return float
     */
    public function subtotal()
    {
        return number_format(
            $this->sum(
                function ($item) {

                    /* @var ItemInterface $item */
                    return $item->price();
                }
            ),
            2
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
}
