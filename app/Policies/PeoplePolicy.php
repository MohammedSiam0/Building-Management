<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\People;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeoplePolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('Read-People')
            ? $this->allow()
            : $this->deny();
    }


    public function view(Admin $admin, People $people)
    {
        return $admin->hasPermissionTo('Read-People')
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
        return $admin->hasPermissionTo('Create-Employee')
            ? $this->allow()
            : $this->deny();
    }



    public function update(Admin $admin, People $people)
    {
        return $admin->hasPermissionTo('Update-People')
            ? $this->allow()
            : $this->deny();
    }
    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\People  $people
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, People $people)
    {
        return $admin->hasPermissionTo('Delete-People')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\People  $people
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, People $people)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\People  $people
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, People $people)
    {
        //
    }
}
