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
        'slug' => 'items',
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
        'sku'      => [
            'required' => true,
        ],
        'name'     => [
            'required' => true,
        ],
        'price'    => [
            'required' => true,
        ],
        'quantity' => [
            'required' => true,
        ],
        'tax',
        'shipping',
        'subtotal',
        'discounts',
        'total',
        'entry',
    ];

}
