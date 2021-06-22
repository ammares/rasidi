<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\ChangeUserPasswordRequest;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('admin::/pages/auth/change_password');
    }

    public function changePassword(ChangeUserPasswordRequest $request)
    {
        if (Hash::check($request->get('current_password'), Auth::user()->password)) {
            Auth::user()->password = bcrypt($request->get('new_password'));
            Auth::user()->save();
             toastr()->success(__('Password has been changed successfully'));

            return redirect('/admin/change_password');
        } else {
             toastr()->error(__('Current password is incorrect'));

            return redirect()->back();
        }
    }
}
