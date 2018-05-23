<?php namespace Anomaly\CartsModule\Item;

use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Traits\Hookable;

/**
 * Class ItemPresenter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     *
     * @var ItemInterface
     */
    protected $object;

    /**
     * Check for purchasable hook
     * attributes before delegating.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        if ($value = parent::__get($key)) {
            return $value;
        }

        $hook = 'get_purchasable_' . snake_case($key);

        /* @var Hookable $purchasable */
        if (!$purchasable = $this->object->getEntry()) {
            return null;
        }

        if ($purchasable->hasHook($hook)) {
            return $purchasable->{camel_case($hook)}();
        }

        return null;
    }
}
