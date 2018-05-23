<?php namespace Anomaly\CartsModule\Http\Controller;

use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class ItemsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Http\Controller
 */
class ItemsController extends PublicController
{

    /**
     * Remove an item from the cart.
     *
     * @param ItemRepositoryInterface $items
     * @param                         $instance
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(ItemRepositoryInterface $items, $id)
    {
        /* @var ItemInterface|EloquentModel $item */
        if ($item = $items->find($id)) {
            $items->delete($item);
        }

        return $this->redirect->back();
    }
}
