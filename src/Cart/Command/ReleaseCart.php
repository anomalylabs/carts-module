<?php namespace Anomaly\CartsModule\Cart\Command;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Illuminate\Session\Store;

/**
 * Class ReleaseCart
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart\Command
 */
class ReleaseCart
{

    /**
     * The cart instance.
     *
     * @var string
     */
    protected $instance;

    /**
     * Create a new ReleaseCart instance.
     *
     * @param $instance
     */
    public function __construct($instance = 'default')
    {
        $this->instance = $instance;
    }

    /**
     * Handle the command.
     *
     * @param Store $session
     * @return CartInterface
     */
    public function handle(Store $session)
    {
        $session->forget('carts.' . $this->instance);
    }
}
