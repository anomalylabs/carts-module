<?php namespace Anomaly\CartsModule\Cart\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface CartRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CartsModule\Cart\Contract
 */
interface CartRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a cart by it's string ID.
     *
     * @param $id
     * @return null|CartInterface
     */
    public function findByStrId($id);
}
