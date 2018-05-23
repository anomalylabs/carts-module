<?php namespace Anomaly\CartsModule\Cart\Command;

use Anomaly\CartsModule\Cart\CartProcessor;
use Anomaly\CartsModule\Cart\Contract\CartInterface;

/**
 * Class ProcessCart
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ProcessCart
{

    /**
     * The cart instance.
     *
     * @var CartInterface
     */
    protected $cart;

    /**
     * Create a new ProcessCart instance.
     *
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle the command.
     *
     * @param CartProcessor $processor
     */
    public function handle(CartProcessor $processor)
    {
        $processor->process($this->cart);
    }
}
