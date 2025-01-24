<?php

namespace App\Http\Controllers\Admin\RolePermission;

use App\Models\Role;
use App\Models\User;
use App\Enums\UserType;
use App\Enums\UserStatus;
use Illuminate\View\View;
use App\Traits\StatusTrait;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserUpdateRequest;

class AdminUserController extends Controller
{
    use StatusTrait;
    public function index(): View
    {
        $this->authorize('view',User::class);
        return view('admin.user.index', [
            'users' => User::query()
                ->select(['id', 'name', 'email', 'role_id', 'image', 'user_status',])
                ->whereNotIn('user_type', [UserType::Admin->value, UserType::SuperAdmin->value])
                ->latest()
                ->get()
        ]);
    }

    public function create(): View
    {
        $this->authorize('create',User::class);

        return view('admin.user.create', [
            'roles' => Role::select(['id', 'name'])->pluck('name', 'id'),
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->authorize('create',User::class);

        DB::beginTransaction();
        // $roleId = $request->role_id;
        // $roleName = Role::where('id', $roleId)->pluck('name')->first();

        try {
            $data = $request->safe()->except('image', 'permissions');
            $data['user_type'] = UserType::Staff->value;
            // $data['user_type'] = $roleName;

            if (!isset($data['user_status'])) {
                $data['user_status'] = UserStatus::Active->value;
            }

            $user = User::create($data);

            $user->permissions()->attach($request->permissions);

            if ($request->hasFile('image')) {
                $user->storeImage('image', 'profile-images', $request->file('image'));
            }

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'User Created Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(User $user): View
    {
        $this->authorize('view',$user);
        $roleId = $user->role_id;
        $roleName = Role::where('id', $roleId)->pluck('name')->first();
        return view('admin.user.show', compact('user','roleName'));
    }

    public function edit(User $user): View
    {
        $this->authorize('update', $user);

        $user->load('permissions:id,name');
        $userRole = Role::with('permissions:id,name')->select(['id', 'name'])->where('id', $user->role_id)->first();

        return view('admin.user.edit', [
            'user' => $user,
            'roles' => Role::select(['id', 'name'])->pluck('name', 'id'),
            'rolePermissions' => $userRole?->permissions,
            'userPermissions' => $user->permissions->pluck('id')->toArray(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $data = $request->safe()->except(['new_password', 'confirm_password', 'current_password', 'image', 'permissions']);

        if ($request->new_password) {
            $currentPasswordStatus = Hash::check($request->current_password, $user->password);

            if (!$currentPasswordStatus) {
                return redirect()->route('admin.users.edit', $user)->with('error', 'Current password does not match');
            }

            $data['password'] = Hash::make($request->new_password);
        }

        if ($request->hasFile('image')) {
            $user->updateImage('image', 'profile-images', $request->file('image'));
        }

        $user->update($data);

        $user->permissions()->sync($request->permissions);
        cache()->forget('user_permissions_' . $user->id);

        return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully!');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete',$user);

        if ($user->image) {
            $user->deleteImage('image', 'profile-images');
        }

        $user->permissions()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('error', 'User Deleted Successfully!');
    }
}
