<?php

namespace  App\Http\Policies;

use App\Http\Sections\PageModules\Icons;
use App\Models\Admin;
use App\Models\PageModules\Icon;
use Illuminate\Auth\Access\HandlesAuthorization;

class IconsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param Icons $section
     * @param Icon $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, Icons $section, Icon $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param Icons $section
     * @param Icon $item
     *
     * @return bool
     */
    public function create(Admin $admin, Icons $section, Icon $item = null)
    {
        if ($admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param Icons $section
     * @param Icon $item
     *
     * @return bool
     */
    public function display(Admin $admin, Icons $section, Icon $item)
    {
        if ($admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param Icons $section
     * @param Icon $item
     *
     * @return bool
     */
    public function edit(Admin $admin, Icons $section, Icon $item)
    {
        if ($admin->hasRole('admin') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param Icons $section
     * @param Icon $item
     *
     * @return bool
     */
    public function delete(Admin $admin, Icons $section, Icon $item)
    {
        
        if ($item->readonly) {
            if ($admin->hasRole('super')) {
                return true;
            }

            return false;    
        }

        return true;
    }
}
