<?php namespace Anomaly\CartsModule\Item;

use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\ProductsModule\Option\OptionCollection;
use Anomaly\ProductsModule\Product\Contract\ProductInterface;
use Anomaly\ProductsModule\Variant\Command\ApplyVariant;
use Anomaly\ProductsModule\Variant\Contract\VariantInterface;
use Anomaly\Streams\Platform\Model\Carts\CartsItemsEntryModel;

/**
 * Class ItemModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Item
 */
class ItemModel extends CartsItemsEntryModel implements ItemInterface
{

    /**
     * Return the price.
     *
     * @return float
     */
    public function price()
    {
        $product = $this->getProduct();

        return $this->getQuantity() * $product->price();
    }

    /**
     * Return the discount.
     *
     * @return float
     */
    public function discount()
    {
        return 0.00;
    }

    /**
     * Get the product.
     *
     * @return ProductInterface
     */
    public function getProduct()
    {
        /* @var ProductInterface $product */
        $product = $this->getAttribute('product');

        if ($variant = $this->getVariant()) {
            $this->dispatch(new ApplyVariant($product, $variant));
        }

        return $product;
    }

    /**
     * Get the product.
     *
     * @return VariantInterface
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * Get the quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the related options.
     *
     * @return OptionCollection
     */
    public function getOptions()
    {
        return $this->options;
    }
}
