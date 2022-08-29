<?php

namespace  App\Http\Policies;

use App\Http\Sections\WB\WBBaseProducts;
use App\Models\Admin;
use App\Models\WBParser\WBBaseProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class WBBaseProductsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param WBBaseProducts $section
     * @param WBBaseProduct $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, WBBaseProducts $section, WBBaseProduct $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param WBBaseProducts $section
     * @param WBBaseProduct $item
     *
     * @return bool
     */
    public function create(Admin $admin, WBBaseProducts $section, WBBaseProduct $item = null)
    {

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param WBBaseProducts $section
     * @param WBBaseProduct $item
     *
     * @return bool
     */
    public function display(Admin $admin, WBBaseProducts $section, WBBaseProduct $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBBaseProducts $section
     * @param WBBaseProduct $item
     *
     * @return bool
     */
    public function edit(Admin $admin, WBBaseProducts $section, WBBaseProduct $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBBaseProducts $section
     * @param WBBaseProduct $item
     *
     * @return bool
     */
    public function delete(Admin $admin, WBBaseProducts $section, WBBaseProduct $item)
    {

        return false;
    }
}
