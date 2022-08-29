<?php

namespace  App\Http\Policies;

use App\Http\Sections\BlockTypes;
use App\Models\Admin;
use App\Models\Blocks\BlockType;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockTypesSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param Admin $admin
     * @param string $ability
     * @param BlockTypes $section
     * @param BlockType $item
     *
     * @return bool
     */
    public function before(Admin $admin, $ability, BlockTypes $section, BlockType $item = null)
    {
    }

    /**
     * @param Admin $admin
     * @param BlockTypes $section
     * @param BlockType $item
     *
     * @return bool
     */
    public function create(Admin $admin, BlockTypes $section, BlockType $item = null)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
    
    /**
     * @param Admin $admin
     * @param BlockTypes $section
     * @param BlockType $item
     *
     * @return bool
     */
    public function display(Admin $admin, BlockTypes $section, BlockType $item)
    {
        return true;
    }

    /**
     * @param Admin $admin
     * @param BlockTypes $section
     * @param BlockType $item
     *
     * @return bool
     */
    public function edit(Admin $admin, BlockTypes $section, BlockType $item)
    {
        if ($admin->hasRole('super')) {
            return true;
        }

        return false;
    }

    /**
     * @param Admin $admin
     * @param BlockTypes $section
     * @param BlockType $item
     *
     * @return bool
     */
    public function delete(Admin $admin, BlockTypes $section, BlockType $item)
    {
        if ($admin->can('edit') || $admin->hasRole('super')) {
            return true;
        }

        return false;
    }
}
