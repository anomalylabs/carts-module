<?php namespace Anomaly\CartsModule\Http\Controller;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CartsModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\ProductsModule\Option\Contract\OptionRepositoryInterface;
use Anomaly\ProductsModule\Option\OptionCollection;
use Anomaly\ProductsModule\Product\Contract\ProductInterface;
use Anomaly\ProductsModule\Product\Contract\ProductRepositoryInterface;
use Anomaly\ProductsModule\Variant\Contract\VariantInterface;
use Anomaly\ProductsModule\Variant\Contract\VariantRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

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
     * Add an item to the cart.
     *
     * @param ItemRepositoryInterface    $items
     * @param OptionRepositoryInterface  $options
     * @param ProductRepositoryInterface $products
     * @param                            $instance
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(
        ItemRepositoryInterface $items,
        OptionRepositoryInterface $options,
        ProductRepositoryInterface $products,
        VariantRepositoryInterface $variants,
        $instance
    ) {
        /* @var CartInterface $cart */
        $cart = $this->dispatch(new GetCart($instance));

        /**
         * Check for a variant first.
         *
         * @var VariantInterface $variant
         */
        if ($variant = $variants->find($this->request->get('variant'))) {

            /* @var ItemInterface $item */
            $item = $items->create(
                [
                    'cart'     => $cart,
                    'variant'  => $variant,
                    'product'  => $variant->getProduct(),
                    'quantity' => $this->request->get('quantity', 1),
                ]
            );

            $item->options()->sync($variant->getOptions());

            return $this->redirect->to('cart');
        }

        /* @var ProductInterface $product */
        $product = $products->find($this->request->get('product'));

        /* @var OptionCollection $selected */
        $selected = $options->findAll($this->request->get('options', []));

        $variants = $product->getVariants();

        $variant = $variants->withOptions($selected);

        if (!$variant && $product->hasVariants()) {

            $this->messages->error('anomaly.module.carts::message.not_available');

            return $this->redirect->back();
        }

        /* @var ItemInterface $item */
        $item = $items->create(
            [
                'cart'     => $cart,
                'product'  => $product,
                'variant'  => $variant,
                'quantity' => $this->request->get('quantity', 1),
            ]
        );

        $item->options()->sync($selected);

        return $this->redirect->to('cart');
    }

    /**
     * Remove an item from the cart.
     *
     * @param ItemRepositoryInterface $items
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(ItemRepositoryInterface $items, $id)
    {
        if ($item = $items->find($id)) {
            $items->delete($item);
        }

        return $this->redirect->back();
    }
}
