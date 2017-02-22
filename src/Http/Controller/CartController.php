<?php namespace Anomaly\CartsModule\Http\Controller;

use Anomaly\CartsModule\Cart\Cart;
use Anomaly\ProductsModule\Product\Command\GetProduct;
use Anomaly\ProductsModule\Product\Contract\ProductInterface;
use Anomaly\ProductsModule\Product\ProductModel;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class CartController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CartController extends PublicController
{

    /**
     * The cart instance.
     *
     * @var Cart
     */
    protected $cart;

    /**
     * Create a new CartController instance.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        parent::__construct();

        $this->cart = $cart;
    }

    /**
     * Add an item to the cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add()
    {
        /* @var ProductInterface $product */
        $product = $this->dispatch(new GetProduct($this->request->get('product')));

        $this->cart->add(
            $product->getId(),
            $product->getName(),
            (int)$this->request->get('quantity', 1),
            $product->price()
        )->associate(ProductModel::class);

        return $this->redirect();
    }

    /**
     * Redirect back as intended.
     *
     * @param null $route
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirect($route = null)
    {
        if ($this->request->get('redirect') == '_self') {
            return $this->redirect->back();
        }

        if ($redirect = $this->request->get('redirect')) {
            return $this->redirect->to($redirect);
        }

        if ($route) {
            return $this->redirect->route($route);
        }

        return $this->redirect->route('anomaly.module.carts::cart.view');
    }

    /**
     * Remove an item from the cart.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $this->cart->remove($id);

        return $this->redirect();
    }

    /**
     * View the contents of a cart.
     *
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function view()
    {
        $this->breadcrumbs->add(
            'anomaly.module.carts::breadcrumb.cart',
            $this->url->route('anomaly.module.carts::carts.view')
        );

        $this->template->set('meta_title', 'anomaly.module.carts::breadcrumb.cart');
        $this->breadcrumbs->add('anomaly.module.carts::breadcrumb.cart', $this->request->fullUrl());

        return $this->view->make(
            'anomaly.module.carts::cart.view',
            [
                'cart' => $this->cart,
            ]
        );
    }

    /**
     * Update all items in a cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        foreach ($this->request->get('quantity') as $id => $quantity) {
            $this->cart->update($id, $quantity);
        }

        return $this->redirect();
    }

    /**
     * Destroy the cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $this->cart->destroy();

        return $this->redirect();
    }
}
