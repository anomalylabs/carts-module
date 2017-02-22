<?php namespace Anomaly\CartsModule;

use Anomaly\CartsModule\Cart\CartModel;
use Anomaly\CartsModule\Cart\CartRepository;
use Anomaly\CartsModule\Cart\Contract\CartRepositoryInterface;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\CartsModule\Item\ItemModel;
use Anomaly\CartsModule\Item\ItemRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Carts\CartsCartsEntryModel;
use Anomaly\Streams\Platform\Model\Carts\CartsItemsEntryModel;

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
        'cart/update/{id}' => [
            'as'   => 'anomaly.module.carts::item.update',
            'uses' => 'Anomaly\CartsModule\Http\Controller\ItemsController@update',
        ],
        'cart/remove/{id}' => [
            'as'   => 'anomaly.module.carts::item.remove',
            'uses' => 'Anomaly\CartsModule\Http\Controller\ItemsController@remove',
        ],
    ];

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        CartsCartsEntryModel::class => CartModel::class,
        CartsItemsEntryModel::class => ItemModel::class,
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        CartRepositoryInterface::class => CartRepository::class,
        ItemRepositoryInterface::class => ItemRepository::class,
    ];
}
