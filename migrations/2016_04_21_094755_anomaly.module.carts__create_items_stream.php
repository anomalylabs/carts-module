<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleCartsCreateItemsStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleCartsCreateItemsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'      => 'items',
        'trashable' => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'cart'     => [
            'required' => true,
        ],
        'quantity' => [
            'required' => true,
        ],
        'product'  => [
            'required' => true,
        ],
        'price'    => [
            'required' => true,
        ],
        'tax',
        'discount',
        'variant',
        'options',
    ];

}
