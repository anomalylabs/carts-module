<?php namespace Anomaly\CartsModule\Item\Contract;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Modifier\ModifierCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Image\Image;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Get the tax.
     *
     * @return float
     */
    public function getTax();

    /**
     * Get the price.
     *
     * @return float
     */
    public function getPrice();

    /**
     * Get the total.
     *
     * @return float
     */
    public function getTotal();

    /**
     * Get the subtotal.
     *
     * @return float
     */
    public function getSubtotal();

    /**
     * Get the shipping.
     *
     * @return float
     */
    public function getShipping();

    /**
     * Get the discounts.
     *
     * @return float
     */
    public function getDiscounts();

    /**
     * Get the item quantity.
     *
     * @return float
     */
    public function getQuantity();


    /**
     * Calculate total adjustments.
     *
     * @param $type
     * @return float
     */
    public function calculate($type);

    /**
     * Get the image.
     *
     * @return null|Image
     */
    public function getImage();

    /**
     * Get the entry.
     *
     * @return EntryInterface
     */
    public function getEntry();

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions();

    /**
     * Get the cart.
     *
     * @return CartInterface
     */
    public function getCart();

    /**
     * Get the cart ID.
     *
     * @return int
     */
    public function getCartId();

    /**
     * Get related modifiers.
     *
     * @return ModifierCollection
     */
    public function getModifiers();

    /**
     * Return the modifiers relationship.
     *
     * @return HasMany
     */
    public function modifiers();
}
