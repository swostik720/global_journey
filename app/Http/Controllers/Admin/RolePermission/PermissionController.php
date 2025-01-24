<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\Traits\DatatableTrait;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionRequest;
use App\Http\Requests\Admin\PermissionUpdateRequest;

class PermissionController extends Controller
{
    use DatatableTrait;

    public function index(Request $request)
    {
        $this->authorize('view', Permission::class);

        if ($request->ajax()) {
            $data = Permission::query()->select(['id', 'name', 'slug'])->latest()->get();

            $config = [
                'additionalColumns' => [],
                'disabledButtons' => ['status'],
                'model' => 'Permission',
                'rawColumns' => [],
                'sortable' => false,
                'routeClass' => null,
            ];

            return $this->getDataTable($request, $data, $config)->make(true);
        }

        return view('admin.permission.index', [
            'columns' => ['name', 'slug'],
        ]);
    }

    public function create(): View
    {
        $this->authorize('create',Permission::class);

        return view('admin.permission.create');
    }

    public function store(PermissionRequest $request): RedirectResponse
    {
        Permission::create($request->validated());

        return redirect()->route('admin.permissions.index')->with('success', 'Permission Created Successfully!');
    }

    public function show(Permission $permission): View
    {
        $this->authorize('view',$permission);

        return view('admin.permission.show', compact('permission'));
    }

    public function edit(Permission $permission): View
    {
        $this->authorize('update',$permission);

        return view('admin.permission.edit', compact('permission'));
    }

    public function update(PermissionUpdateRequest $request, Permission $permission): RedirectResponse
    {
        $this->authorize('update',$permission);

        $permission->update($request->validated());

        return redirect()->route('admin.permissions.index')->with('success', 'Permission Updated Successfully!');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $this->authorize('delete',$permission);

        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('error', 'Permission Deleted Successfully!');
    }
}
