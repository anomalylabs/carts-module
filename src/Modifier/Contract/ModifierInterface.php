<?php namespace Anomaly\CartsModule\Modifier\Contract;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Interface ModifierInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ModifierInterface extends EntryInterface
{

    /**
     * Apply the modifier to the value.
     *
     * @param $value
     * @return float
     */
    public function apply($value);

    /**
     * Calculate the value.
     *
     * @param $value
     * @return float
     */
    public function calculate($value);

    /**
     * Return whether this modifier
     * is an addition or not.
     *
     * @return bool
     */
    public function isAddition();

    /**
     * Return whether this modifier
     * is a subtraction or not.
     *
     * @return bool
     */
    public function isSubtraction();

    /**
     * Get the related cart.
     *
     * @return CartInterface
     */
    public function getCart();

    /**
     * Get the related item.
     *
     * @return ItemInterface
     */
    public function getItem();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the type.
     *
     * @return string
     */
    public function getType();

    /**
     * Get the scope.
     *
     * @return string
     */
    public function getScope();

    /**
     * Get the target.
     *
     * @return string
     */
    public function getTarget();

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue();

}
