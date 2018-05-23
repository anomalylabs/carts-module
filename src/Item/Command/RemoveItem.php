<?php namespace Anomaly\CartsModule\Item\Command;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;

/**
 * Class RemoveItem
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RemoveItem
{

    /**
     * The cart instance.
     *
     * @var CartInterface
     */
    protected $cart;

    /**
     * The item ID.
     *
     * @var int
     */
    protected $item;

    /**
     * Create a new RemoveItem instance.
     *
     * @param CartInterface $cart
     * @param $id
     */
    public function __construct(CartInterface $cart, $id)
    {
        $this->cart = $cart;
        $this->id   = $id;
    }

    /**
     * Handle the command.
     *
     * @param ItemRepositoryInterface $items
     */
    public function handle(ItemRepositoryInterface $items)
    {
        $items->delete(
            $this->cart
                ->getItems()
                ->find($this->id)
        );
    }
}
