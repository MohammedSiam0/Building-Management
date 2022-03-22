<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Purchase;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;

    /**
     *
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasPermissionTo('Read-Purchases')
            ? $this->allow()
            : $this->deny();
    }



    public function view(Admin $admin, Purchase $purchase)
    {
        return $admin->hasPermissionTo('Read-Purchases')
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
        return $admin->hasPermissionTo('Create-Purchases')
            ? $this->allow()
            : $this->deny();
    }


    public function update(Admin $admin, Purchase $purchase)
    {
        return $admin->hasPermissionTo('Update-Purchases')
            ? $this->allow()
            : $this->deny();
    }


    public function delete(Admin $admin, Purchase $purchase)
    {
        return $admin->hasPermissionTo('Delete-Purchases')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Purchases $purchases)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Purchases  $purchases
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Purchases $purchases)
    {
        //
    }
}
