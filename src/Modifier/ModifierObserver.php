<?php namespace Anomaly\CartsModule\Modifier;

use Anomaly\CartsModule\Modifier\Command\SetCart;
use Anomaly\CartsModule\Modifier\Contract\ModifierInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class ModifierObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ModifierObserver extends EntryObserver
{

    /**
     * Run before a record is created.
     *
     * @param EntryInterface|ModifierInterface $entry
     */
    public function creating(EntryInterface $entry)
    {
        $this->dispatch(new SetCart($entry));

        parent::creating($entry);
    }
}
