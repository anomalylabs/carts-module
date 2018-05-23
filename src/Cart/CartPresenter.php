<?php namespace Anomaly\CartsModule\Cart;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Illuminate\Session\Store;

/**
 * Class CartPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart
 */
class CartPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     *
     * @var CartInterface
     */
    protected $object;

    /**
     * The session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * Return the status of the cart.
     *
     * @return string
     */
    public function status()
    {
        $date = $this->object->lastModified();

        if ($date->diffInMinutes() < 15) {
            return 'active';
        }

        if ($date->diffInMinutes() < 60) {
            return 'stale';
        }

        return 'abandoned';
    }

    /**
     * Return the status label.
     *
     * @param string $size
     * @return string
     */
    public function label($text = null, $context = null, $size = null)
    {
        if (!$text) {
            switch ($this->status()) {
                case 'active':
                    return parent::label('anomaly.module.carts::status.active', 'success', $size);
                    break;

                case 'stale':
                    return parent::label('anomaly.module.carts::status.stale', 'warning', $size);
                    break;

                case 'abandoned':
                    return parent::label('anomaly.module.carts::status.abandoned', 'default', $size);
                    break;
            }

            return parent::label('anomaly.module.cart::status.abandoned', 'secondary', $size);
        }

        return parent::label($text, $context, $size);
    }
}
