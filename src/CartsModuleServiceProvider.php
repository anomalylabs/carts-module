<?php namespace Anomaly\CartsModule;

use Anomaly\CartsModule\Cart\CartModel;
use Anomaly\CartsModule\Cart\CartProcessor;
use Anomaly\CartsModule\Cart\CartRepository;
use Anomaly\CartsModule\Cart\Contract\CartRepositoryInterface;
use Anomaly\CartsModule\Cart\Listener\AddUserToCart;
use Anomaly\CartsModule\Cart\Listener\ProcessCart;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\CartsModule\Item\ItemModel;
use Anomaly\CartsModule\Item\ItemProcessor;
use Anomaly\CartsModule\Item\ItemRepository;
use Anomaly\CartsModule\Item\Listener\ProcessItems;
use Anomaly\CartsModule\Modifier\Contract\ModifierRepositoryInterface;
use Anomaly\CartsModule\Modifier\ModifierModel;
use Anomaly\CartsModule\Modifier\ModifierRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Carts\CartsCartsEntryModel;
use Anomaly\Streams\Platform\Model\Carts\CartsItemsEntryModel;
use Anomaly\Streams\Platform\Model\Carts\CartsModifiersEntryModel;
use Anomaly\UsersModule\User\Event\UserWasLoggedIn;
use Illuminate\Contracts\Config\Repository;

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
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        UserWasLoggedIn::class => [
            AddUserToCart::class,
            ProcessItems::class,
            ProcessCart::class,
        ],
    ];

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        CartsCartsEntryModel::class     => CartModel::class,
        CartsItemsEntryModel::class     => ItemModel::class,
        CartsModifiersEntryModel::class => ModifierModel::class,
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        CartProcessor::class               => CartProcessor::class,
        ItemProcessor::class               => ItemProcessor::class,
        CartRepositoryInterface::class     => CartRepository::class,
        ItemRepositoryInterface::class     => ItemRepository::class,
        ModifierRepositoryInterface::class => ModifierRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'cart'                    => [
            'as'   => 'anomaly.module.carts::carts.view',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartsController@view',
        ],
        'carts/{instance}/update' => [
            'as'   => 'anomaly.module.carts::carts.update',
            'uses' => 'Anomaly\CartsModule\Http\Controller\CartsController@update',
        ],
        'carts/items/remove/{id}' => [
            'as'   => 'anomaly.module.carts::items.remove',
            'uses' => 'Anomaly\CartsModule\Http\Controller\ItemsController@remove',
        ],
    ];

    /**
     * Register the addon.
     *
     * @param CartProcessor $carts
     * @param ItemProcessor $items
     * @param Repository    $config
     */
    public function register(CartProcessor $carts, ItemProcessor $items, Repository $config)
    {
        $items->setProcessors($config->get($this->addon->getNamespace('processors.items'), []));
        $carts->setProcessors($config->get($this->addon->getNamespace('processors.carts'), []));
    }
}
