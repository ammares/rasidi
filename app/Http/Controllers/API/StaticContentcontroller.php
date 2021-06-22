<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\IntroductionResource;
use App\Models\Introduction;
use App\Models\SystemPreference;

class StaticContentController extends Controller
{
    public function introductions()
    {
        return response()->json([
            'data' => [
                'introductions' => IntroductionResource::collection(Introduction::where('type', 'introductions')->orderBy('order')->get()),
            ],
        ], 200);
    }

    public function termsOfUse()
    {
        return response()->json([
            'data' => [
                'terms_of_use' => SystemPreference::getByName("term_of_use_" . app()->getLocale()),
            ],
        ], 200);
    }

    public function privacyPolicy()
    {
        return response()->json([
            'data' => [
                'privacy_policy' => SystemPreference::getByName("privacy_policy_" . app()->getLocale()),
            ],
        ], 200);
    }

    public function howItWorksAndKeyFeatures()
    {
        return response()->json([
            'data' => [
                'how_it_works' => IntroductionResource::collection(Introduction::where('type', 'how_it_works')->orderBy('order')->get()),
                'key_features' => IntroductionResource::collection(Introduction::where('type', 'key_features')->orderBy('order')->get()),
            ],
        ], 200);
    }
}
