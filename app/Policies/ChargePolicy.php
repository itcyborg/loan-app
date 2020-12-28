<?php

namespace App\Policies;

use App\Charge;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChargePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // view any charge
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Charge  $charge
     * @return mixed
     */
    public function view(User $user, Charge $charge)
    {
        // view charge
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // create charge
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Charge  $charge
     * @return mixed
     */
    public function update(User $user, Charge $charge)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Charge  $charge
     * @return mixed
     */
    public function delete(User $user, Charge $charge)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Charge  $charge
     * @return mixed
     */
    public function restore(User $user, Charge $charge)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Charge  $charge
     * @return mixed
     */
    public function forceDelete(User $user, Charge $charge)
    {
        //
    }
}
