<?php namespace Anomaly\CartsModule\Http\Controller;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class CartsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Http\Controller
 */
class CartsController extends PublicController
{

    /**
     * View the contents of a cart.
     *
     * @param string $instance
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view($instance = 'default')
    {
        $cart = $this->dispatch(new GetCart($instance));

        $this->template->set('meta_title', 'Cart');

        return $this->view->make('anomaly.module.carts::carts.view', compact('cart'));
    }

    /**
     * Update all items in a cart.
     *
     * @param ItemRepositoryInterface $items
     * @param string                  $instance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ItemRepositoryInterface $items, $instance = 'default')
    {
        /* @var CartInterface $cart */
        $cart = $this->dispatch(new GetCart($instance));

        foreach ($this->request->get('quantity') as $id => $quantity) {

            /* @var ItemInterface $item */
            if ($item = $cart->getItems()->find($id)) {

                if ($quantity == 0) {

                    $items->delete($item);

                    continue;
                }

                $items->save($item->setAttribute('quantity', $quantity));
            }
        }

        return $this->redirect->back();
    }
}
