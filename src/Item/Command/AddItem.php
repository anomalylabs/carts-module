<?php namespace Anomaly\CartsModule\Item\Command;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\CartsModule\Item\ItemModel;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddItem
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddItem
{

    use DispatchesJobs;

    /**
     * The cart instance.
     *
     * @var CartInterface
     */
    protected $cart;

    /**
     * The item payload.
     *
     * @var mixed
     */
    protected $item;

    /**
     * The item quantity.
     *
     * @var int
     */
    protected $quantity;

    /**
     * Create a new AddItem instance.
     *
     * @param CartInterface $cart
     * @param               $item
     * @param int           $quantity
     */
    public function __construct(CartInterface $cart, $item, $quantity = 1)
    {
        $this->cart     = $cart;
        $this->item     = $item;
        $this->quantity = $quantity;
    }

    /**
     * Handle the command.
     *
     * @throws \Exception
     */
    public function handle(ItemRepositoryInterface $items)
    {
        if ($this->item) {

            if (!$this->item->isPurchasable()) {
                throw new \Exception('Item is not purchasable at this time.');
            }

            /* @var ItemInterface|EloquentModel $item */
            if ($item = $this->cart->getItems()->findBy('sku', $this->item->getPurchasableSku())) {

                $this->dispatch(new ProcessItem($item));

                $items->save($item->setAttribute('quantity', $item->getQuantity() + $this->quantity));

                return;
            }

            $items->save(
                $item = new ItemModel(
                    [
                        'cart'     => $this->cart,
                        'quantity' => $this->quantity,
                        'sku'      => $this->item->getPurchasableSku(),
                        'name'     => $this->item->getPurchasableName(),
                        'price'    => $this->item->getPurchasablePrice(),
                        'entry'    => $this->item,
                    ]
                )
            );

            $this->dispatch(new ProcessItem($item));

            $items->save($item);

            return;
        }

        $items->save(
            $item = new ItemModel(
                array_merge(
                    [
                        'cart'     => $this->cart,
                        'quantity' => $this->quantity,
                    ],
                    $this->item
                )
            )
        );

        $this->dispatch(new ProcessItem($item));

        $items->save($item);
    }
}
