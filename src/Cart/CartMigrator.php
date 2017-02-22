<?php namespace Anomaly\CartsModule\Cart;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CheckoutsModule\Checkout\Contract\CheckoutInterface;
use Anomaly\OrdersModule\Item\Contract\ItemRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CartMigrator
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart
 */
class CartMigrator
{

    use DispatchesJobs;

    /**
     * The item repository.
     *
     * @var ItemRepositoryInterface
     */
    protected $items;

    /**
     * Create a new CartMigrator instance.
     *
     * @param ItemRepositoryInterface $items
     */
    public function __construct(ItemRepositoryInterface $items)
    {
        $this->items = $items;
    }

    /**
     * Migrate the cart into a checkout.
     *
     * @param CheckoutInterface $checkout
     */
    public function migrate(CheckoutInterface $checkout)
    {
        $order = $checkout->getOrder();

        /* @var CartInterface $cart */
        $cart = $this->dispatch(new GetCart());

        /* @var ItemInterface $item */
        foreach ($cart->getItems() as $item) {

            $product = $item->getProduct();

            $item = $this->items->create(
                [
                    'product'  => $product,
                    'price'    => $item->price(),
                    'quantity' => $item->getQuantity(),
                    'variant'  => $item->getVariant(),
                    'order'    => $order,
                ]
            );

            $item
                ->options()
                ->sync($item->getOptions());
        }
    }
}
