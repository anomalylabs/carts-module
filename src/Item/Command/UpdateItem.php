<?php namespace Anomaly\CartsModule\Item\Command;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class UpdateItem
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UpdateItem
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
    protected $id;

    /**
     * The item parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new UpdateItem instance.
     *
     * @param CartInterface $cart
     * @param $item
     * @param int $quantity
     */
    public function __construct(CartInterface $cart, $id, array $parameters)
    {
        $this->id         = $id;
        $this->cart       = $cart;
        $this->parameters = $parameters;
    }

    /**
     * Handle the command.
     *
     * @return ItemInterface
     * @throws \Exception
     */
    public function handle(ItemRepositoryInterface $items)
    {
        /* @var ItemInterface|EloquentModel $item */
        $item = $this->cart->getItems()->find($this->id);

        if ($quantity = array_pull($this->parameters, 'quantity')) {
            $item->setAttribute('quantity', $quantity);
        }

        $item->fill($this->parameters);

        $items->save($item);

        return $item;
    }
}
