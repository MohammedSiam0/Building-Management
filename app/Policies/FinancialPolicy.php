<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Financial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FinancialPolicy
{
    use HandlesAuthorization;

    /**
     * @param Admin $admin
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('Read-Financial')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Financial $financial)
    {
        return $admin->hasPermissionTo('Read-Financial')
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
        return $admin->hasPermissionTo('Create-Financial')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Financial $financial)
    {
        return $admin->hasPermissionTo('Update-Financial')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Financial $financial)
    {
        return $admin->hasPermissionTo('Delete-Financial')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Financial $financial)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Financial  $financial
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Financial $financial)
    {
        //
    }
}
