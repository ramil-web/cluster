<?php

namespace  App\Http\Policies;

use App\Http\Sections\WB\WBOrders;
use App\Models\Admin;
use App\Models\WBParser\WBOrder;
use Illuminate\Auth\Access\HandlesAuthorization;

class WBOrdersSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param WBOrders $section
     * @param WBOrder $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, WBOrders $section, WBOrder $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param WBOrders $section
     * @param WBOrder $item
     *
     * @return bool
     */
    public function create(Admin $admin, WBOrders $section, WBOrder $item = null)
    {

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param WBOrders $section
     * @param WBOrder $item
     *
     * @return bool
     */
    public function display(Admin $admin, WBOrders $section, WBOrder $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBOrders $section
     * @param WBOrder $item
     *
     * @return bool
     */
    public function edit(Admin $admin, WBOrders $section, WBOrder $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBOrders $section
     * @param WBOrder $item
     *
     * @return bool
     */
    public function delete(Admin $admin, WBOrders $section, WBOrder $item)
    {

        return false;
    }
}
