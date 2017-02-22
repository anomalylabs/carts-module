<?php namespace Anomaly\CartsModule\Cart\Command;

use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CartsModule\Item\ItemCollection;
use Anomaly\ProductsModule\Variant\VariantApplicator;

/**
 * Class ApplyVariants
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart\Command
 */
class ApplyVariants
{

    /**
     * The item collection.
     *
     * @var ItemCollection
     */
    protected $items;

    /**
     * Create a new ApplyVariants instance.
     *
     * @param ItemCollection $items
     */
    public function __construct(ItemCollection $items)
    {
        $this->items = $items;
    }

    /**
     * Handle the command.
     *
     * @param VariantApplicator $applicator
     * @return ItemCollection
     */
    public function handle(VariantApplicator $applicator)
    {
        /* @var ItemInterface $item */
        foreach ($this->items as $item) {
            if ($variant = $item->getVariant()) {
                $applicator->apply($item->getProduct(), $variant);
            }
        }

        return $this->items;
    }
}
