<?php namespace Anomaly\CartsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;

/**
 * Class CartsModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule
 */
class CartsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        CartsModulePlugin::class,
    ];

    /**
     * The addon providers.
     *
     * @var array
     */
    protected $providers = [
        ShoppingcartServiceProvider::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'cart'             => [
            'as'   => 'anomaly.module.carts::cart.view',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartController@view',
        ],
        'cart/add'         => [
            'as'   => 'anomaly.module.carts::cart.add',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartController@add',
        ],
        'cart/update'      => [
            'as'   => 'anomaly.module.carts::cart.update',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartController@update',
        ],
        'cart/destroy'     => [
            'as'   => 'anomaly.module.carts::cart.destroy',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartController@destroy',
        ],
        'cart/remove/{id}' => [
            'as'   => 'anomaly.module.carts::cart.remove',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartController@remove',
        ],
    ];
}
