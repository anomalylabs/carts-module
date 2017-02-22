<?php namespace Anomaly\CartsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

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
        'Anomaly\CartsModule\CartsModulePlugin',
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'cart/{instance?}'              => [
            'as'   => 'anomaly.module.carts::carts.view',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartsController@view',
        ],
        'carts/{instance}/update'       => [
            'as'   => 'anomaly.module.carts::carts.update',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartsController@update',
        ],
        'carts/{instance}/items/add'    => [
            'as'   => 'anomaly.module.carts::items.add',
            'uses' => 'Anomaly\CartsModule\Http\Controller\ItemsController@add',
        ],
        'carts/{instance}/items/update' => [
            'as'   => 'anomaly.module.carts::items.update',
            'uses' => 'Anomaly\CartsModule\Http\Controller\ItemsController@update',
        ],
        'carts/items/remove/{id}'       => [
            'as'   => 'anomaly.module.carts::items.remove',
            'uses' => 'Anomaly\CartsModule\Http\Controller\ItemsController@remove',
        ],
    ];

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        'Anomaly\Streams\Platform\Model\Carts\CartsCartsEntryModel' => 'Anomaly\CartsModule\Cart\CartModel',
        'Anomaly\Streams\Platform\Model\Carts\CartsItemsEntryModel' => 'Anomaly\CartsModule\Item\ItemModel',
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\CartsModule\Cart\Contract\CartRepositoryInterface' => 'Anomaly\CartsModule\Cart\CartRepository',
        'Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface' => 'Anomaly\CartsModule\Item\ItemRepository',
    ];

}
