<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SystemPreference;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Modules\Admin\Http\Requests\BusinesProfilePagesRequest;
use Modules\Admin\Http\Requests\EmailSettingsRequest;
use Modules\Admin\Http\Requests\LegalPagesRequest;

class SystemPreferencesController extends Controller
{
    public function generalSettings()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['name' => __('global.general')],
        ];

        return view('admin::pages/settings/general/index',
            [
                'breadcrumbs' => $breadcrumbs,
            ]);
    }

    public function emailSettings()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['link' => "admin/settings/general", 'name' => __('global.general')],
            ['name' => __('global.email_settings')],
        ];

        return view('admin::pages/settings/general/email_settings/index', [
            'email_settings' => SystemPreference::getByType('email_setting')->groupBy('key'),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function storeEmailSettings(EmailSettingsRequest $request)
    {
        $this->store($request, 'email_setting');
        Artisan::call('optimize');
        
        toastr()->success(__('global.saved_successfully'));
        return redirect()->back();
    }

    public function legalPages()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['name' => __('global.legal')],
        ];

        return view('admin::pages/settings/legal/index', [
            'legal_pages' => SystemPreference::getByType('legal_pages')->groupBy('key'),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function storeLegalPages(LegalPagesRequest $request)
    {
        $this->store($request, 'legal_pages');
        
        toastr()->success(__('global.saved_successfully'));
        return redirect()->back();
    }

    public function businessProfilePages()
    {
        $breadcrumbs = [
            ['link' => "admin/settings", 'name' => __('global.settings')],
            ['name' => __('global.business_profile')],
        ];

        return view('admin::pages/settings/business_profile/index', [
            'business_profile_pages' => SystemPreference::getByType('business_profile_pages')->groupBy('key'),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function storeBusinessProfilePages(BusinesProfilePagesRequest $request)
    {
        $this->store($request, 'business_profile_pages');
        
        toastr()->success(__('global.saved_successfully'));
        return redirect()->back();
    }

    private function store($request, $type = '')
    {
        $post_data = $request->validated();

        foreach ($request->file() as $key => $file) {
            $img_options = ['image_quality' => 70];

            $post_data[$key] = Helper::storeImage(
                $request->file($key),
                storage_path('app/public/system_preferences/'),
                $img_options
            );

            $system_preferences = SystemPreference::getByName($key);
            if ($system_preferences && $system_preferences->value) {
                Storage::disk('public')->delete('system_preferences/' . $system_preferences->value);
            }
        }

        foreach ($post_data as $key => $value) {
            if (is_array($value)) {
                $value = implode(',', $value);
            }
            SystemPreference::updateOrCreate(
                ['key' => $key],
                [
                    'type' => $type,
                    'value' => $value ?? '',
                ]
            );
        }

        // update the config file
        Artisan::call('config:system-preferences');
    }
}
