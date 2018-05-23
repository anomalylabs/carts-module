<?php namespace Anomaly\CartsModule\Item;

use Anomaly\CartsModule\Item\Contract\ItemInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class ItemProcessor
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemProcessor
{

    /**
     * The configured processors.
     *
     * @var array
     */
    protected $processors = [];

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new CartProcessor instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Process the item.
     *
     * @param ItemInterface $item
     */
    public function process(ItemInterface $item)
    {
        foreach (array_filter($this->processors) as $processor) {
            $this->container->call(
                $processor,
                [
                    'target' => $item,
                ],
                'process'
            );
        }
    }

    /**
     * Get the processors.
     *
     * @return array
     */
    public function getProcessors()
    {
        return $this->processors;
    }

    /**
     * Set the processors.
     *
     * @param array $processors
     * @return $this
     */
    public function setProcessors(array $processors)
    {
        $this->processors = $processors;

        return $this;
    }

    /**
     * Add a processor.
     *
     * @param $processor
     * @return $this
     */
    public function addProcessor($processor)
    {
        $this->processors[] = $processor;

        return $this;
    }
}
