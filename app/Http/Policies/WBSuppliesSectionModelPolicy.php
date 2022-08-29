<?php

namespace  App\Http\Policies;

use App\Http\Sections\WB\WBSupplies;
use App\Models\Admin;
use App\Models\WBParser\WBSupply;
use Illuminate\Auth\Access\HandlesAuthorization;

class WBSuppliesSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param WBSupplies $section
     * @param WBSupply $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, WBSupplies $section, WBSupply $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param WBSupplies $section
     * @param WBSupply $item
     *
     * @return bool
     */
    public function create(Admin $admin, WBSupplies $section, WBSupply $item = null)
    {

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param WBSupplies $section
     * @param WBSupply $item
     *
     * @return bool
     */
    public function display(Admin $admin, WBSupplies $section, WBSupply $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBSupplies $section
     * @param WBSupply $item
     *
     * @return bool
     */
    public function edit(Admin $admin, WBSupplies $section, WBSupply $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBSupplies $section
     * @param WBSupply $item
     *
     * @return bool
     */
    public function delete(Admin $admin, WBSupplies $section, WBSupply $item)
    {

        return false;
    }
}
