<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use App\Models\export;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExportPolicy
{
    use HandlesAuthorization;
    /***
     * @param Admin $admin
     * @return \Illuminate\Auth\Access\Response
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('Read-Export')
            ? $this->allow()
            : $this->deny();
    }



    public function view(Admin $admin, export $export)
    {
        return $admin->hasPermissionTo('Read-Export')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('Create-Export')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\export  $export
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, export $export)
    {
        return $admin->hasPermissionTo('Update-Export')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\export  $export
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, export $export)
    {
        //
        return $admin->hasPermissionTo('Delete-Export')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\export  $export
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, export $export)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\export  $export
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, export $export)
    {
        //
    }
}
