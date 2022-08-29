<?php

namespace  App\Http\Policies;

use App\Http\Sections\Users;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, Users $section, User $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function create(Admin $admin, Users $section, User $item = null)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function display(Admin $admin, Users $section, User $item)
    {
        return true;
    }

    /**
     * @param Admin $admin
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function edit(Admin $admin, Users $section, User $item)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param Users $section
     * @param User $item
     *
     * @return bool
     */
    public function delete(Admin $admin, Users $section, User $item)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
}
