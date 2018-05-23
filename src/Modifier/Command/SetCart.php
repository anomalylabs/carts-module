<?php namespace Anomaly\CartsModule\Modifier\Command;

use Anomaly\CartsModule\Modifier\Contract\ModifierInterface;

/**
 * Class SetCart
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetCart
{

    /**
     * The modifier instance.
     *
     * @var ModifierInterface
     */
    protected $modifier;

    /**
     * Create a new SetCart instance.
     *
     * @param ModifierInterface $modifier
     */
    public function __construct(ModifierInterface $modifier)
    {
        $this->modifier = $modifier;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if ($this->modifier->getCart()) {
            return;
        }

        if (!$item = $this->modifier->getItem()) {
            return;
        }

        $this->modifier->setAttribute('cart_id', $item->getCartId());
    }
}
