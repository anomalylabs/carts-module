<?php namespace Anomaly\CartsModule\Cart\Command;

use Anomaly\CartsModule\Cart\CartManager;
use Anomaly\CartsModule\Cart\Contract\CartInterface;

/**
 * Class GetCart
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart\Command
 */
class GetCart
{

    /**
     * The cart instance.
     *
     * @var string
     */
    protected $instance;

    /**
     * Create a new GetCart instance.
     *
     * @param null $instance
     */
    public function __construct($instance = null)
    {
        $this->instance = $instance;
    }

    /**
     * Handle the command.
     *
     * @param CartManager $instance
     * @return CartInterface
     */
    public function handle(CartManager $manager)
    {
        return $manager->cart($this->instance);
    }
}
