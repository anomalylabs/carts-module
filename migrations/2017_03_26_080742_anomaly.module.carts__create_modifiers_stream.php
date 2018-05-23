<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleCartsCreateModifiersStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleCartsCreateModifiersStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'     => 'modifiers',
        'sortable' => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'  => [
            'required' => true,
        ],
        'type'  => [
            'required' => true,
        ],
        'value' => [
            'required' => true,
        ],
        'cart'  => [
            'required' => true,
        ],
        'item',
        'entry',
    ];

}
