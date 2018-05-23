<?php namespace Anomaly\CartsModule\Cart\Command;

use Anomaly\CartsModule\Cart\CartInstance;
use Illuminate\Session\Store;

/**
 * Class DestroyCart
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart\Command
 */
class DestroyCart
{

    /**
     * The cart instance.
     *
     * @var string
     */
    protected $instance;

    /**
     * Create a new DestroyCart instance.
     *
     * @param $instance
     */
    public function __construct($instance = null)
    {
        $this->instance = $instance;
    }

    /**
     * Handle the command.
     *
     * @param Store $session
     */
    public function handle(CartInstance $instance)
    {
        $instance->destroy($this->instance);
    }
}
