<?php

namespace App\Policies;

use App\Disbursement;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisbursementPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Disbursement  $disbursement
     * @return mixed
     */
    public function view(User $user, Disbursement $disbursement)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Disbursement  $disbursement
     * @return mixed
     */
    public function update(User $user, Disbursement $disbursement)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Disbursement  $disbursement
     * @return mixed
     */
    public function delete(User $user, Disbursement $disbursement)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Disbursement  $disbursement
     * @return mixed
     */
    public function restore(User $user, Disbursement $disbursement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Disbursement  $disbursement
     * @return mixed
     */
    public function forceDelete(User $user, Disbursement $disbursement)
    {
        //
    }
}
