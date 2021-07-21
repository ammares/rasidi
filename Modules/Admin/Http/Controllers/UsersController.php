<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Admin\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Traits\SendEmail;

class UsersController extends Controller
{
    use SendEmail;

    public function index()
    {
        if (\Request::ajax()) {
            return User::loadAll();
        }

        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['name' => __('global.users')],
        ];

        return view('admin::pages/settings/users/index', [
            'roles' => Role::all(),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function store(UserRequest $request)
    {
        $input = $request->validated();
        if ($request->ajax()) {
            try {
                DB::beginTransaction();
                if ($request->hasFile('avatar')) {
                    $input['avatar'] = Helper::storeImage($request->file('avatar'), storage_path('app/public/avatars/'), [
                        'thumbnail_path' => storage_path('app/public/avatars/thumbnail/'),
                        'thumbnail_width' => 200,
                        'image_width' => 1080,
                        'image_quality' => 100,
                    ]);
                }
                $clear_text_pass = $input['password'];
                $input['password']=bcrypt($input['password']);
                $user=User::create($input);
                if(!Empty($request['role'])){
                    $user->assignRole(Role::findByName($request['role']));
                }
                DB::commit();

                /*$this->sendEmail($user, 'user_login_credentials', [
                    'business_name' => config('system-preferences.business_name'),
                    'username' => $input['name'],
                    'url' => route('home'),
                    'email' => $input['email'],
                    'password' => $clear_text_pass,
                ]);*/

                return response()->json([
                    'message' => __('global.saved_successfully'),
                ], 200);
            } catch (\Exception $exception) {
                if ($request->hasFile('avatar')) {
                    Storage::delete('avatars/' . $request->file('avatar'));
                    Storage::delete('avatars/thumbnail/' . $request->file('avatar'));
                }
                DB::rollback();
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $roles='';
        if ($id != 1){
            $roles = $user->roles;
        }
        $input = $request->validated();
        try {
            DB::beginTransaction();
            if ($request->hasFile('avatar')) {
                $input['avatar'] = Helper::storeImage($request->file('avatar'), storage_path('app/public/avatars/'), [
                    'thumbnail_path' => storage_path('app/public/avatars/thumbnail/'),
                    'thumbnail_width' => 200,
                    'image_width' => 1080,
                    'image_quality' => 100,
                ]);
                if ($user->avatar && 'user_silhouette.png' != $user->avatar) {
                    Storage::delete('avatars/' . $user->avatar);
                    Storage::delete('avatars/thumbnail/' . $user->avatar);
                }
            }
            $user->update($input);
            if($roles){
                foreach ($roles as $role){
                        $user->removeRole(Role::findByName($role->name));
                }
            }
            if(!Empty($request['role'])){
                $user->assignRole(Role::findByName($request['role']));
            }
            DB::commit();
            return response()->json([
                'message' => __('global.updated_successfully'),
            ], 200);
        } catch (\Exception $exception) {
            if ($request->hasFile('avatar')) {
                Storage::delete('avatars/' . $request->file('avatar'));
                Storage::delete('avatars/thumbnail/' . $request->file('avatar'));
            }
            DB::rollback();
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
        abort(404);
    }

    public function activateDeactivate($id)
    {
        if (\Request::ajax()) {
            try {
                $user = User::findOrFail($id);
                $user->update(['active' => $user->active == 0 ? 1 : 0]);

                return response()->json([
                    'message' => __('global.updated_successfully'),
                ], 200);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }

    public function resetPassword($id)
    {
        if (\Request::ajax()) {
            try {
                $user = User::findOrFail($id);

                $password = str::random(8);
                $user->update(['password' => Hash::make($password)]);

                $message = __('global.password_reset')
                    . '<button class="mx-2 btn btn-warning waves-effect waves-float waves-light" onclick="copyToClipboard(\'' . $password . '\')">'
                    . __('global.copy') . '</button>';

                return response()->json([
                    'message' => $message,
                ], 200);
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => $exception->getMessage(),
                ], 400);
            }
        }
        abort(404);
    }
}
