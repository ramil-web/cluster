<?php

namespace  App\Http\Policies;

use App\Http\Sections\Sidebars;
use App\Models\Admin;
use App\Models\Sidebar;
use Illuminate\Auth\Access\HandlesAuthorization;

class SidebarsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param Sidebars $section
     * @param Sidebar $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, Sidebars $section, Sidebar $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param Sidebars $section
     * @param Sidebar $item
     *
     * @return bool
     */
    public function create(Admin $admin, Sidebars $section, Sidebar $item = null)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param Sidebars $section
     * @param Sidebar $item
     *
     * @return bool
     */
    public function display(Admin $admin, Sidebars $section, Sidebar $item)
    {
        return true;
    }

    /**
     * @param Admin $admin
     * @param Sidebars $section
     * @param Sidebar $item
     *
     * @return bool
     */
    public function edit(Admin $admin, Sidebars $section, Sidebar $item)
    {
        return true;
    }

    /**
     * @param Admin $admin
     * @param Sidebars $section
     * @param Sidebar $item
     *
     * @return bool
     */
    public function delete(Admin $admin, Sidebars $section, Sidebar $item)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
}
