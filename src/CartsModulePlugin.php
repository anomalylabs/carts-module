<?php namespace Anomaly\CartsModule;

use Anomaly\CartsModule\Cart\Cart;
use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;

/**
 * Class CartsModulePlugin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule
 */
class CartsModulePlugin extends Plugin
{

    /**
     * The runtime cache.
     *
     * @var array
     */
    protected $cache = [];

    /**
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'cart',
                function () {

                    if (isset($this->cache[$key = __METHOD__])) {
                        return $this->cache[$key];
                    }

                    return $this->cache[$key] = app(Cart::class);
                }
            ),
        ];
    }
}
