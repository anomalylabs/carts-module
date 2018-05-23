<?php namespace Anomaly\CartsModule\Cart\Listener;

use Anomaly\CartsModule\Cart\CartProcessor;
use Anomaly\CartsModule\Cart\Command\GetCart;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ProcessCart
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ProcessCart
{

    use DispatchesJobs;

    /**
     * The cart processor.
     *
     * @var CartProcessor
     */
    protected $processor;

    /**
     * Create a new ProcessCart instance.
     *
     * @param CartProcessor $processor
     */
    public function __construct(CartProcessor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        $this->processor->process($this->dispatch(new GetCart()));
    }
}
