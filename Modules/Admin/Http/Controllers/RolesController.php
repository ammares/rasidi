<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['name' => __('global.roles_and_permissions')],
        ];

        return view('admin::pages/settings/roles/index', [
            'roles' => Role::with('permissions')->paginate(15),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/roles", 'name' => __('global.roles_and_permissions')],
            ['name' => __('global.new')],
        ];

        $permissions = $this->getPermissions();

        return view('admin::pages/settings/roles/create', [
            'permissions' => $permissions,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function store(RoleRequest $request)
    {
        $input = $request->all();
        try {
            $role = Role::create([
                'name' => mb_strtolower(str_replace(' ', '_', $input['title']), 'utf8'),
                'description' => $input['description'],
            ]);
            $this->syncRolePermissions($role, $request->input('abilities'));
            toastr()->success(__('global.saved_successfully'));
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage());
        }

        return redirect()->route('settings.roles');
    }

    public function edit($id)
    {
        $role = Role::findOrfail($id);

        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/roles", 'name' => __('global.roles_and_permissions')],
            ['name' => __('global.edit')],
        ];

        return view(
            'admin::pages/settings/roles/edit',
            [
                'role' => $role,
                'permissions' => $this->getPermissions(),
                'role_permissions' => $role->permissions->groupBy('name')->toArray(),
                'breadcrumbs' => $breadcrumbs,
            ],
        );
    }

    public function update(RoleRequest $request, $id)
    {
        $input = $request->all();
        try {
            $role = Role::findOrfail($id);
            if (1 == $role->id) {
                $role->update(['description' => $input['description']]);
            } else {
                $role->update([
                    'name' => mb_strtolower(str_replace(' ', '_', $input['title']), 'utf8'),
                    'description' => $input['description'],
                ]);
                $this->syncRolePermissions($role, $request->input('abilities'));
            }
            toastr()->success(__('global.updated_successfully'));
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage());
        }
        return redirect()->route('settings.roles');
    }

    public function destroy(Role $role)
    {
        if (\Request::ajax()) {
            try {
                if ($role->users()->exists()) {
                    return response()->json([
                        'message' => __('global.not_allowed_to_delete_role_related_to_user'),
                    ], 400);
                }
                if (1 == $role->id) {
                    toastr()->error(__('global.undefined_index'));
                    return redirect()->route('settings.roles');
                }
                $role->delete();
                return response()->json([
                    'message' => __('global.deleted_successfully'),
                ], 200);

            } catch (\Exception $exception) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }

    private function syncRolePermissions($role, $abilities)
    {
        if ($abilities) {
            for ($i = 0; $i < count($abilities); $i++) {
                $has_parent = strrpos($abilities[$i], '.');
                if ($has_parent) {
                    $parent = substr($abilities[$i], 0, $has_parent);
                    $is_store = str_ends_with($abilities[$i], '.store');
                    if ($is_store) {
                        $create = $parent . '.create';
                        $this->addRole($abilities, $create);
                    }
                    $is_update = str_ends_with($abilities[$i], '.update');
                    if ($is_update) {
                        $edit = $parent . '.edit';
                        $this->addRole($abilities, $edit);
                    }
                    $this->addRole($abilities, $parent);
                }
            }
            $role->syncPermissions($abilities);
        }
    }

    private function addRole(&$array, $permission)
    {
        $is_exists = Permission::where('name', $permission)->first();
        $is_submitted = in_array($permission, $array, true);
        if ($is_exists && !$is_submitted) {
            array_push($array, $permission);
        }
    }

    private function getPermissions()
    {
        return Permission::where([
            ['name', '!=', 'home'],
            ['name', 'not like', '%.create'],
            ['name', 'not like', '%.edit']])
            ->orderBy('name')
            ->pluck('name')
            ->groupBy(function ($permission) {
                $permission_arr = explode('.', $permission);
                if (count($permission_arr) > 2) {
                    return $permission_arr[1];
                }
                return $permission_arr[0];
            })
            ->toArray();
    }
}
