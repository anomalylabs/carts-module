<?php namespace Anomaly\CartsModule\Cart;

/**
 * Class Cart
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Cart extends \Gloudemans\Shoppingcart\Cart
{

    /**
     * Return the cart content.
     *
     * @return \Illuminate\Support\Collection
     */
    public function content()
    {
        $content = parent::content();

        foreach ($content as $item) {
            $item->entry = $item->model;
        }

        return $content;
    }
}
