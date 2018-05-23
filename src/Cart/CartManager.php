<?php namespace Anomaly\CartsModule\Cart;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Cart\Contract\CartRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * Class CartManager
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CartManager
{

    public static $instance = 'default';

    /**
     * The cart repository.
     *
     * @var CartRepositoryInterface
     */
    protected $carts;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The cart persistence.
     *
     * @var CartPersistence
     */
    protected $persistence;

    /**
     * The auth guard.
     *
     * @var Guard
     */
    protected $auth;


    /**
     * Create a new CartInstance instance.
     *
     * @param CartRepositoryInterface $carts
     * @param Request                 $request
     * @param CartPersistence         $persistence
     * @param Guard                   $auth
     */
    public function __construct(
        CartRepositoryInterface $carts,
        Request $request,
        CartPersistence $persistence,
        Guard $auth
    ) {
        $this->auth        = $auth;
        $this->carts       = $carts;
        $this->request     = $request;
        $this->persistence = $persistence;
    }

    /**
     * Return a cart instance.
     *
     * @param null $instance
     * @return CartInterface
     */
    public function cart($instance = null)
    {
        $instance = $instance ?: self::$instance;

        /* @var CartInterface $cart */
        if (!$cart = $this->carts->findByStrId($this->persistence->id($instance))) {
            $cart = $this->carts->newInstance(
                [
                    'user'       => $this->auth->user(),
                    'ip_address' => $this->request->ip(),
                    'instance'   => $instance,
                ]
            );
        }

        $this->persistence->persist($instance, $cart->getStrId());

        return $cart;
    }

    /**
     * Release a cart.
     *
     * @param null $instance
     */
    public function destroy($instance = null)
    {
        $instance = $instance ?: self::$instance;

        /* @var CartInterface|EloquentModel $cart */
        if (!$cart = $this->carts->findByStrId($this->persistence->id($instance))) {
            $this->carts->delete($cart);
        }

        $this->persistence->forget($instance);
    }
}
