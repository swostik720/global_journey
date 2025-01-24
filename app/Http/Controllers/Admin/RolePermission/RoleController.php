<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\Models\Role;
use Illuminate\View\View;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Traits\DatatableTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;

class RoleController extends Controller
{
    use DatatableTrait;
    public function index(Request $request)
    {
        $this->authorize('view',Role::class);

        if ($request->ajax()) {
            $data = Role::query()->select(['id', 'name', 'slug'])->latest()->get();

            $config = [
                'additionalColumns' => [],
                'disabledButtons' => [],
                'model' => 'Role',
                'rawColumns' => [],
                'sortable' => false,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $data, $config)->make(true);
        }

        return view('admin.role.index', [
            'columns' => ['name', 'slug'],
        ]);
    }

    public function create(): View
    {
        $this->authorize('create',Role::class);

        return view('admin.role.create', [
            'permissions' => Permission::select(['id', 'name'])->get()
        ]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $role = Role::create($request->safe()->except('permissions'));

        $role->permissions()->sync($request->permissions, []);

        return redirect()->route('admin.roles.index')->with('success', 'Role Created Successfully!');
    }

    public function show(Role $role): View
    {
        $this->authorize('view',$role);
        return view('admin.role.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        $this->authorize('update', $role);

        $role->load('permissions:id,name');
        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => Permission::select(['id', 'name'])->get(),
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        $this->authorize('update', $role);

        $role->update($request->safe()->except('permissions'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role Updated Successfully!');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('delete',$role);

        $role->delete();

        return redirect()->route('admin.roles.index')->with('error', 'Role Deleted Successfully!');
    }
}
