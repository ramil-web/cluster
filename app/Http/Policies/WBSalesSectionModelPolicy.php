<?php

namespace  App\Http\Policies;

use App\Http\Sections\WB\WBSales;
use App\Models\Admin;
use App\Models\WBParser\WBSale;
use Illuminate\Auth\Access\HandlesAuthorization;

class WBSalesSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param WBSales $section
     * @param WBSale $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, WBSales $section, WBSale $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param WBSales $section
     * @param WBSale $item
     *
     * @return bool
     */
    public function create(Admin $admin, WBSales $section, WBSale $item = null)
    {

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param WBSales $section
     * @param WBSale $item
     *
     * @return bool
     */
    public function display(Admin $admin, WBSales $section, WBSale $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBSales $section
     * @param WBSale $item
     *
     * @return bool
     */
    public function edit(Admin $admin, WBSales $section, WBSale $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBSales $section
     * @param WBSale $item
     *
     * @return bool
     */
    public function delete(Admin $admin, WBSales $section, WBSale $item)
    {

        return false;
    }
}
