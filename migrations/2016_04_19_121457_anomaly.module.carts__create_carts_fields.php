<?php

use Anomaly\CartsModule\Cart\CartModel;
use Anomaly\CartsModule\Item\ItemModel;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\UsersModule\User\UserModel;

/**
 * Class AnomalyModuleCartCreateCartFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleCartsCreateCartsFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'str_id'        => 'anomaly.field_type.text',
        'sku'           => 'anomaly.field_type.text',
        'name'          => 'anomaly.field_type.text',
        'price'         => 'anomaly.field_type.decimal',
        'total'         => 'anomaly.field_type.decimal',
        'tax'           => 'anomaly.field_type.decimal',
        'shipping'      => 'anomaly.field_type.decimal',
        'subtotal'      => 'anomaly.field_type.decimal',
        'discounts'     => 'anomaly.field_type.decimal',
        'instance'      => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'default_value' => 'default',
            ],
        ],
        'ip_address'    => 'anomaly.field_type.text',
        'quantity'      => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min' => 1,
            ],
        ],
        'cart'          => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CartModel::class,
            ],
        ],
        'item'          => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => ItemModel::class,
            ],
        ],
        'discount_code' => 'anomaly.field_type.polymorphic',
        'user'          => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => UserModel::class,
            ],
        ],
        'type'          => 'anomaly.field_type.slug',
        'value'         => 'anomaly.field_type.text',
        'options'       => 'anomaly.field_type.textarea',
        'entry'         => 'anomaly.field_type.polymorphic',
    ];

}
