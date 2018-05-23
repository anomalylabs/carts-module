<?php namespace Anomaly\CartsModule\Cart\Contract;

use Anomaly\CartsModule\Item\ItemCollection;
use Anomaly\CartsModule\Modifier\ModifierCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface CartInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart\Contract
 */
interface CartInterface extends EntryInterface
{

    /**
     * Add a cart item.
     *
     * @param $item
     * @param int $quantity
     */
    public function add($item, $quantity = 1);

    /**
     * Remove a cart item.
     *
     * @param $id
     */
    public function remove($id);

    /**
     * Return the cart total.
     */
    public function total();

    /**
     * Return the cart subtotal.
     */
    public function subtotal();

    /**
     * Get the tax.
     *
     * @return float
     */
    public function getTax();

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
     * Return the total adjustments.
     *
     * @param        $type
     * @param string $target
     */
    public function adjustments($type);

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId();

    /**
     * Get the instance.
     *
     * @return string
     */
    public function getInstance();

    /**
     * Calculate total adjustments.
     *
     * @param $type
     * @return float
     */
    public function calculate($type);

    /**
     * Get the user.
     *
     * @return null|UserInterface
     */
    public function getUser();

    /**
     * Get related items.
     *
     * @return ItemCollection
     */
    public function getItems();

    /**
     * Return the items relationship.
     *
     * @return HasMany
     */
    public function items();

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
