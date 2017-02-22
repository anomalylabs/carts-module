<?php namespace Anomaly\CartsModule\Item\Contract;

use Anomaly\ProductsModule\Option\OptionCollection;
use Anomaly\ProductsModule\Product\Contract\ProductInterface;
use Anomaly\ProductsModule\Variant\Contract\VariantInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Interface ItemInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Item\Contract
 */
interface ItemInterface extends EntryInterface
{

    /**
     * Return the price.
     *
     * @return float
     */
    public function price();

    /**
     * Return the discount.
     *
     * @return float
     */
    public function discount();

    /**
     * Get the product.
     *
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * Get the variant.
     *
     * @return VariantInterface
     */
    public function getVariant();

    /**
     * Get the quantity.
     *
     * @return int
     */
    public function getQuantity();

    /**
     * Get the related options.
     *
     * @return OptionCollection
     */
    public function getOptions();

    /**
     * Return the option relationship.
     *
     * @return BelongsToMany
     */
    public function options();
}
