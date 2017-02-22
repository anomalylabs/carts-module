<?php namespace Anomaly\CartsModule\Cart\Command;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Cart\Contract\CartRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

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
     * @param $instance
     */
    public function __construct($instance = 'default')
    {
        $this->instance = $instance;
    }

    /**
     * Handle the command.
     *
     * @param CartRepositoryInterface $carts
     * @param Store                   $session
     * @param Guard                   $auth
     * @param Request                 $request
     * @return CartInterface
     */
    public function handle(CartRepositoryInterface $carts, Store $session, Guard $auth, Request $request)
    {

        if (!$cart = $carts->findByStrId($session->get('carts.' . $this->instance))) {
            $cart = $carts->create(
                [
                    'user'       => $auth->user(),
                    'session'    => $session->getId(),
                    'ip_address' => $request->ip(),
                    'instance'   => 'default',
                ]
            );
        }

        /* @var CartInterface $cart */
        $session->set('carts.' . $this->instance, $cart->getStrId());

        $cart->applyVariants();

        return $cart;
    }
}
