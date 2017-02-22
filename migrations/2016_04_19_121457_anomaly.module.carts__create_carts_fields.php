<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

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
        'session'       => 'anomaly.field_type.text',
        'price'         => 'anomaly.field_type.decimal',
        'tax'           => 'anomaly.field_type.decimal',
        'discount'      => 'anomaly.field_type.decimal',
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
                'related' => 'Anomaly\CartsModule\Cart\CartModel',
            ],
        ],
        'discount_code' => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\DiscountsModule\Discount\DiscountModel',
            ],
        ],
        'user'          => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\UsersModule\User\UserModel',
            ],
        ],
        'product'       => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\ProductsModule\Product\ProductModel',
            ],
        ],
        'variant'       => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\ProductsModule\Variant\VariantModel',
            ],
        ],
        'options'       => [
            'type'   => 'anomaly.field_type.multiple',
            'config' => [
                'related' => 'Anomaly\ProductsModule\Option\OptionModel',
            ],
        ],
    ];

}
