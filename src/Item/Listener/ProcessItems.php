<?php namespace Anomaly\CartsModule\Item\Listener;

use Anomaly\CartsModule\Cart\Command\GetCart;
use Anomaly\CartsModule\Cart\Contract\CartInterface;
use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Anomaly\CartsModule\Item\ItemProcessor;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ProcessItems
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ProcessItems
{

    use DispatchesJobs;

    /**
     * The cart processor.
     *
     * @var ItemProcessor
     */
    protected $processor;

    /**
     * Create a new ProcessItems instance.
     *
     * @param ItemProcessor $processor
     */
    public function __construct(ItemProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        /* @var CartInterface $cart */
        $cart = $this->dispatch(new GetCart());

        /* @var ItemInterface $item */
        foreach ($cart->getItems() as $item) {
            $this->processor->process($item);
        }
    }
}
