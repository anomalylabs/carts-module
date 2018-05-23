<?php namespace Anomaly\CartsModule\Cart;

use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Cart\Contract\CartRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class CartRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart
 */
class CartRepository extends EntryRepository implements CartRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var CartModel
     */
    protected $model;

    /**
     * Create a new CartRepository instance.
     *
     * @param CartModel $model
     */
    public function __construct(CartModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a cart by it's string ID.
     *
     * @param $id
     * @return null|CartInterface
     */
    public function findByStrId($id)
    {
        return $this->model->where('str_id', $id)->first();
    }
}
