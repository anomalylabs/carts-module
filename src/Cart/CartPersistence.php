<?php namespace Anomaly\CartsModule\Cart;

use Illuminate\Contracts\Session\Session;

/**
 * Class CartPersistence
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CartPersistence
{

    /**
     * The key prefix.
     *
     * @var string
     */
    public static $prefix = 'cart.';

    /**
     * The session interface.
     *
     * @var Session
     */
    protected $session;

    /**
     * Create a new CartPersistence instance.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Persist an instance ID.
     *
     * @param $instance
     * @param $id
     */
    public function persist($instance, $id)
    {
        $this->session->put($this::$prefix . $instance, $id);
    }

    /**
     * Get an instance ID from persistence.
     *
     * @param $instance
     * @param $id
     * @return string
     */
    public function id($instance)
    {
        return $this->session->get($this::$prefix . $instance);
    }

    /**
     * Forget an instance ID.
     *
     * @param $instance
     */
    public function forget($instance)
    {
        $this->session->forget($this::$prefix . $instance);
    }
}
