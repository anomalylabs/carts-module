<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleCartsCreateCartsStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleCartsCreateCartsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'      => 'carts',
        'trashable' => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'str_id'     => [
            'required' => true,
            'unique'   => true,
        ],
        'session'    => [
            'required' => true,
        ],
        'instance'   => [
            'required' => true,
        ],
        'ip_address' => [
            'required' => true,
        ],
        'user',
        'discount',
    ];

}
