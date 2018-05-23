<?php namespace Anomaly\CartsModule\Cart;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Command\AddItem;
use Anomaly\CartsModule\Item\Command\RemoveItem;
use Anomaly\CartsModule\Item\Command\UpdateItem;
use Anomaly\CartsModule\Item\ItemCollection;
use Anomaly\CartsModule\Item\ItemModel;
use Anomaly\CartsModule\Modifier\Contract\ModifierInterface;
use Anomaly\CartsModule\Modifier\ModifierCollection;
use Anomaly\CartsModule\Modifier\ModifierModel;
use Anomaly\Streams\Platform\Model\Carts\CartsCartsEntryModel;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CartModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CartModel extends CartsCartsEntryModel implements CartInterface
{

    /**
     * The cascading relations.
     *
     * @var array
     */
    protected $cascades = [
        'items',
        'modifiers',
    ];

    /**
     * The eager loaded relations.
     *
     * @var array
     */
    protected $with = [
        //'items',
        //'modifiers',
    ];

    /**
     * Add a cart item.
     *
     * @param     $item
     * @param int $quantity
     */
    public function add($item, $quantity = 1)
    {
        $this->dispatch(new AddItem($this->dispatch(new GetCart()), $item, $quantity));
    }

    /**
     * Remove a cart item.
     *
     * @param $id
     */
    public function remove($id)
    {
        $this->dispatch(new RemoveItem($this->dispatch(new GetCart()), $id));
    }

    /**
     * Return the cart total.
     *
     * @return float
     */
    public function total()
    {
        /* @var CartInterface $cart */
        $cart = $this->dispatch(new GetCart());

        return $cart->total();
    }

    /**
     * Return the cart subtotal.
     *
     * @return float
     */
    public function subtotal()
    {
        /* @var CartInterface $cart */
        $cart = $this->dispatch(new GetCart());

        return $cart->subtotal();
    }

    /**
     * Return the total adjustments.
     *
     * @param        $type
     * @param string $target
     */
    public function adjustments($type)
    {
        $items = $this->getItems();

        $modifiers = $this
            ->getModifiers()
            ->type($type);

        return $items->adjustments($type) + $modifiers->calculate($items->total());
    }

    /**
     * Calculate total adjustments.
     *
     * @param $type
     * @return float
     */
    public function calculate($type)
    {
        $modifiers = $this
            ->getModifiers()
            ->type($type);

        return $modifiers->calculate($this->getSubtotal());
    }

    /**
     * Return the total discounts.
     *
     * @param $target
     * @return float
     */
    protected function adjust($value)
    {
        $modifiers = $this->getModifiers();

        /* @var ModifierInterface $modifier */
        foreach ($modifiers as $modifier) {
            $value = $modifier->apply($value);
        }

        return $value;
    }

    /**
     * Get the tax.
     *
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Get the total.
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Get the subtotal.
     *
     * @return float
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Get the shipping.
     *
     * @return float
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Get the discounts.
     *
     * @return float
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * Get the quantity.
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId()
    {
        return $this->str_id;
    }

    /**
     * Get the instance.
     *
     * @return string
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Get the user.
     *
     * @return null|UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get related items.
     *
     * @return ItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Return the items relationship.
     *
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(ItemModel::class, 'cart_id');
    }

    /**
     * Get related modifiers.
     *
     * @return ModifierCollection
     */
    public function getModifiers()
    {
        return $this->modifiers;
    }

    /**
     * Return the modifiers relationship.
     *
     * @return HasMany
     */
    public function modifiers()
    {
        return $this->hasMany(ModifierModel::class, 'cart_id')
            ->whereNull('item_id');
    }

}
