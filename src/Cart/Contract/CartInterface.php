<?php namespace Anomaly\CartsModule\Cart\Contract;

use Anomaly\CartsModule\Item\ItemCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
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
     * Apply the item variants.
     *
     * @return $this;
     */
    public function applyVariants();

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId();

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
}
