<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    public function __invoke(Request $request)
    {
        return Role::where('id', $request->role_id)->first()->permissions;
    }
}
