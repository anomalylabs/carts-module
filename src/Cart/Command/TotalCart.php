<?php namespace Anomaly\CartsModule\Cart\Command;

use Anomaly\CartsModule\Cart\Contract\CartInterface;

/**
 * Class TotalCart
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TotalCart
{

    /**
     * The cart instance.
     *
     * @var CartInterface
     */
    protected $cart;

    /**
     * Create a new TotalCart instance.
     *
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $items = $this->cart->getItems();

        $this->cart->setAttribute('quantity', $items->quantity());
        $this->cart->setAttribute('subtotal', $items->subtotal());
        $this->cart->setAttribute('tax', $items->tax() + $this->cart->calculate('tax'));
        $this->cart->setAttribute('shipping', $items->shipping() + $this->cart->calculate('shipping'));
        $this->cart->setAttribute('discounts', $items->discounts() + $this->cart->calculate('discount'));

        $this->cart->setAttribute(
            'total',
            $this->cart->getSubtotal()
            - $this->cart->getDiscounts()
            + $this->cart->getShipping()
            + $this->cart->getTax()
        );
    }
}
