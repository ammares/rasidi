<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\ChangeUserPasswordRequest;
use Modules\Admin\Http\Requests\UpdateProfileRequest;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('admin::pages/user_profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        $post_data = $request->validated();
        
        if ($request->hasFile('avatar')) {
            $post_data['avatar'] = Helper::storeImage($request->file('avatar'), storage_path('app/public/avatars/'), [
                'thumbnail_path' => storage_path('app/public/avatars/thumbnail/'),
                'thumbnail_width' => 165,
                'image_width' => 1080,
                'image_quality' => 90,
            ]);
            if (Auth::user()->avatar && 'user_silhouette.png' != Auth::user()->avatar) {
                Storage::delete('avatars/' . Auth::user()->avatar);
                Storage::delete('avatars/thumbnail/' . Auth::user()->avatar);
            }
        }
        Auth::user()->update($post_data);

        toastr()->success(__('Saved Successfully'));
        return back()->withInput();
    }
    public function changePassword(ChangeUserPasswordRequest $request)
    {
        if (Hash::check($request->get('current_password'), Auth::user()->password)) {
            Auth::user()->password = bcrypt($request->get('new_password'));
            Auth::user()->save();

            toastr()->success(__('global.password_has_been_changed_successfully'));
            return redirect()->back();
        }
        toastr()->error(__('global.current_password_is_incorrect'));
        return redirect()->back();
    }
}
