<?php namespace Anomaly\CartsModule\Item\Command;

use Anomaly\CartsModule\Item\Contract\ItemInterface;

/**
 * Class TotalItem
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TotalItem
{

    /**
     * The item instance.
     *
     * @var ItemInterface
     */
    protected $item;

    /**
     * Create a new TotalItem instance.
     *
     * @param ItemInterface $item
     */
    public function __construct(ItemInterface $item)
    {
        $this->item = $item;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $this->item->load('modifiers');

        $this->item->setAttribute(
            'subtotal',
            $this->item->getQuantity() * $this->item->getPrice()
        );

        $this->item->setAttribute('tax', $this->item->calculate('tax'));
        $this->item->setAttribute('shipping', $this->item->calculate('shipping'));
        $this->item->setAttribute('discounts', $this->item->calculate('discount'));

        $this->item->setAttribute(
            'total',
            $this->item->getSubtotal()
            - $this->item->getDiscounts()
            + $this->item->getShipping()
            + $this->item->getTax()
        );
    }
}
