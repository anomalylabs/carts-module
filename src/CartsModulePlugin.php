<?php namespace Anomaly\CartsModule;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Support\Decorator;

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
     * Get the functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'cart',
                function ($instance = 'default') {
                    return (new Decorator())->decorate($this->dispatch(new GetCart($instance)));
                }
            ),
        ];
    }

}
