<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /*****************policy using the role id************************/
    // public function before(User $user): Response
    // {
    //     return in_array($user->role_id, [(config('global.is_superadmin')), (config('global.is_admin'))], true)
    //         ? Response::allow()
    //         : Response::deny('You do not have the permission for this operation.');
    // }
    // public function view(User $user, Role $role): Response
    // {
    //     return in_array($user->role_id, [(config('global.is_superadmin')), (config('global.is_admin'))], true)
    //         ? Response::allow()
    //         : Response::deny('You do not have the permission for this operation.');
    // }

    // public function create(User $user): Response
    // {
    //     return in_array($user->role_id, [(config('global.is_superadmin')), (config('global.is_admin'))], true)
    //         ? Response::allow()
    //         : Response::deny('You do not have the permission for this operation.');
    // }

    // public function update(User $user, Role $role): Response
    // {
    //     return in_array($user->role_id, [(config('global.is_superadmin')), (config('global.is_admin'))], true)
    //         ? Response::allow()
    //         : Response::deny('You do not have the permission for this operation.');
    // }

    // public function delete(User $user, Role $role): Response
    // {
    //     return in_array($user->role_id, [(config('global.is_superadmin')), (config('global.is_admin'))], true)
    //         ? Response::allow()
    //         : Response::deny('You do not have the permission for this operation.');
    // }

    // public function restore(User $user, Role $role): Response
    // {
    //     return in_array($user->role_id, [(config('global.is_superadmin'))], true)
    //         ? Response::allow()
    //         : Response::deny('You do not have the permission for this operation.');
    // }

    // public function forceDelete(User $user, Role $role): Response
    // {
    //     return in_array($user->role_id, [(config('global.is_superadmin'))], true)
    //         ? Response::allow()
    //         : Response::deny('You do not have the permission for this operation.');
    // }


    /*****************policy using the permission and slug************************/
    /**comment out the before method for working other method as permission slug if the before method is not comment out then 
    other method will not work as ecpected because before method will only aloww the super admin user **/

    // public function before(User $user): Response
    // {
    //     if (!$user->role) {
    //         return Response::deny('You do not have a role.');
    //     }
    //     return in_array($user->role_id, [(config('global.is_superadmin'))], true)
    //         ? Response::allow()
    //         : Response::deny('You do not have the permission for this operation.');
    // }
    public function create(User $user)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('add-role')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }
    public function view(User $user)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('access-role-page')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }
    public function update(User $user, Role $role)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('edit-role')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }

    public function delete(User $user, Role $role)
    {
        if (!$user->role) {
            return Response::deny('You do not have a role.');
        }

        return $user->hasPermissionTo('delete-role')
            ? Response::allow()
            : Response::deny('You do not have the permission for this operation.');
    }
}
