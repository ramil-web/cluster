<?php

namespace  App\Http\Policies;

use App\Http\Sections\Users;
use App\Http\Sections\Admins;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param Admins $section
     * @param Admin $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, Admins $section, Admin $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param Admins $section
     * @param Admin $item
     *
     * @return bool
     */
    public function create(Admin $admin, Admins $section, Admin $item = null)
    {
        if ($admin->hasRole('super')) {
            return true;
        }

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param Admins $section
     * @param Admin $item
     *
     * @return bool
     */
    public function display(Admin $admin, Admins $section, Admin $item)
    {
        if ($admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param Admins $section
     * @param Admin $item
     *
     * @return bool
     */
    public function edit(Admin $admin, Admins $section, Admin $item)
    {
        if ($admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param Admins $section
     * @param Admin $item
     *
     * @return bool
     */
    public function delete(Admin $admin, Admins $section, Admin $item)
    {
        if ($admin->hasRole('super')) {
            return true;
        }

        return false;
    }
}
