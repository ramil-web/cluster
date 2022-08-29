<?php

namespace  App\Http\Policies;

use App\Http\Sections\PageTypes;
use App\Models\Admin;
use App\Models\PageType;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageTypesSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param PageTypes $section
     * @param PageType $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, PageTypes $section, PageType $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param PageTypes $section
     * @param PageType $item
     *
     * @return bool
     */
    public function create(Admin $admin, PageTypes $section, PageType $item = null)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param PageTypes $section
     * @param PageType $item
     *
     * @return bool
     */
    public function display(Admin $admin, PageTypes $section, PageType $item)
    {
        return true;
    }

    /**
     * @param Admin $admin
     * @param PageTypes $section
     * @param PageType $item
     *
     * @return bool
     */
    public function edit(Admin $admin, PageTypes $section, PageType $item)
    {
        return true;
    }

    /**
     * @param Admin $admin
     * @param PageTypes $section
     * @param PageType $item
     *
     * @return bool
     */
    public function delete(Admin $admin, PageTypes $section, PageType $item)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
}
