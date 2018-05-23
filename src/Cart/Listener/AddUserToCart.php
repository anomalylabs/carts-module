<?php namespace Anomaly\CartsModule\Cart\Listener;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CartsModule\Cart\Command\GetCartInstance;
use Anomaly\CartsModule\Cart\Contract\CartRepositoryInterface;
use Anomaly\UsersModule\User\Event\UserWasLoggedIn;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddUserToCart
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart\Listener
 */
class AddUserToCart
{

    use DispatchesJobs;

    /**
     * The cart manager.
     *
     * @var CartRepositoryInterface $carts
     */
    protected $carts;

    /**
     * Create a new AddUserToCart instance.
     *
     * @param CartRepositoryInterface $carts
     */
    public function __construct(CartRepositoryInterface $carts)
    {
        $this->carts = $carts;
    }

    /**
     * Handle the event.
     *
     * @param UserWasLoggedIn $event
     */
    public function handle(UserWasLoggedIn $event)
    {
        $cart = $this->dispatch(new GetCart());

        $this->carts->save($cart->setAttribute('user', $event->getUser()));
    }
}
