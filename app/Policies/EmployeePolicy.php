<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    /***
     * @param Admin $admin
     * @return \Illuminate\Auth\Access\Response
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('Read-Employee')
            ? $this->allow()
            : $this->deny();
    }


    public function view(Admin $admin, Employee $employee)
    {
        return $admin->hasPermissionTo('Read-Employee')
            ? $this->allow()
            : $this->deny();
    }
    /**
     * @param User $user
     * @return \Illuminate\Auth\Access\Response
     */
    public function create(Admin $admin)
    {
        return $admin->hasPermissionTo('Create-Employee')
            ? $this->allow()
            : $this->deny();
    }


    public function update(Admin $admin, Employee $employee)
    {
        //
        return $admin->hasPermissionTo('Update-Employee')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * @param Admin $admin
     * @param Employee $employee
     * @return \Illuminate\Auth\Access\Response
     */
    public function delete(Admin $admin, Employee $employee)
    {
        return $admin->hasPermissionTo('Delete-Employee')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Employee $employee)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Employee $employee)
    {
        //
    }
}
