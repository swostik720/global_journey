<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    // public function viewAny(User $user): bool
    // {
    //     //
    // }

    /**comment out the before method for working other method as permission slug if the before method is not comment out then 
    other method will not work as ecpected because before method will only aloww the super admin user **/

    public function before(User $user): Response
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }
        return in_array($user->role_id, [(config('global.is_superadmin'))], true)
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }
    public function view(User $user)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('access-permission-page')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    public function create(User $user)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('add-permission')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    public function update(User $user, Permission $permission)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('edit-permission')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    public function delete(User $user, Permission $permission)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('delete-permission')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    // public function restore(User $user, Permission $permission): bool
    // {
    //     //
    // }

    // public function forceDelete(User $user, Permission $permission): bool
    // {
    //     //
    // }
}
