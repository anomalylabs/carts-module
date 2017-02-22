<?php namespace Anomaly\CartsModule\Http\Controller\Admin;

use Anomaly\CartsModule\Cart\Form\CartFormBuilder;
use Anomaly\CartsModule\Cart\Table\CartTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class CartsModule extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param CartTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CartTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param CartFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CartFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param CartFormBuilder $form
     * @param                 $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CartFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
