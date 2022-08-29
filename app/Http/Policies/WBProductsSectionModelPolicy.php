<?php

namespace  App\Http\Policies;

use App\Http\Sections\WB\WBProducts;
use App\Models\Admin;
use App\Models\WBParser\WBProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class WBProductsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param WBProducts $section
     * @param WBProduct $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, WBProducts $section, WBProduct $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param WBProducts $section
     * @param WBProduct $item
     *
     * @return bool
     */
    public function create(Admin $admin, WBProducts $section, WBProduct $item = null)
    {

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param WBProducts $section
     * @param WBProduct $item
     *
     * @return bool
     */
    public function display(Admin $admin, WBProducts $section, WBProduct $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBProducts $section
     * @param WBProduct $item
     *
     * @return bool
     */
    public function edit(Admin $admin, WBProducts $section, WBProduct $item)
    {
        if ($admin->hasRole('wb_product_editor') || $admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param WBProducts $section
     * @param WBProduct $item
     *
     * @return bool
     */
    public function delete(Admin $admin, WBProducts $section, WBProduct $item)
    {

        return false;
    }
}
