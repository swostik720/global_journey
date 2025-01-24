<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    // public function viewAny(User $user)
    // {
    //     //
    // }

    public function view(User $user)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('access-user-page')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    public function create(User $user)
    {
        if (!$user->role) {
            return Response::deny('Only admin can create new user.');
        }

        return $user->hasPermissionTo('add-user')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    public function update(User $user, User $model)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('edit-user')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    public function delete(User $user, User $model)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('delete-user')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    public function restore(User $user, User $model)
    {
        //
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }
}
