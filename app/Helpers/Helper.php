<?php

namespace App\Helpers;

use App\Models\UserPreferences;
use Illuminate\Support\Facades\Config;
use Faker\Provider\Image as ProviderImage;
use Illuminate\Support\Str;
use Spatie\Image\Image;
use App\Models\Country;
use App\Models\City;
use GuzzleHttp\Client as GuzzleClient;

class Helper
{
    public static function applClasses()
    {
        // Demo
        $fullURL = request()->fullurl();
        if (App()->environment() === 'production') {
            for ($i = 1; $i < 7; $i++) {
                $contains = Str::contains($fullURL, 'demo-' . $i);
                if ($contains === true) {
                    $data = config('custom.' . 'demo-' . $i);
                }
            }
        } else {
            $data = config('custom.custom');
        }

        // default data array
        $DefaultData = [
            'mainLayoutType' => 'vertical',
            'theme' => 'light',
            'sidebarCollapsed' => false,
            'navbarColor' => '',
            'horizontalMenuType' => 'floating',
            'verticalMenuNavbarType' => 'floating',
            'footerType' => 'static', //footer
            'layoutWidth' => 'full',
            'showMenu' => true,
            'bodyClass' => '',
            'bodyStyle' => '',
            'pageClass' => '',
            'pageHeader' => true,
            'contentLayout' => 'default',
            'blankPage' => false,
            'defaultLanguage' => 'en',
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'),
        ];

        // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
        $data = array_merge($DefaultData, $data);

        // All options available in the template
        $allOptions = [
            'mainLayoutType' => array('vertical', 'horizontal'),
            'theme' => array('light' => 'light', 'dark' => 'dark-layout', 'bordered' => 'bordered-layout', 'semi-dark' => 'semi-dark-layout'),
            'sidebarCollapsed' => array(true, false),
            'showMenu' => array(true, false),
            'layoutWidth' => array('full', 'boxed'),
            'navbarColor' => array('bg-primary', 'bg-info', 'bg-warning', 'bg-success', 'bg-danger', 'bg-dark'),
            'horizontalMenuType' => array('floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky'),
            'horizontalMenuClass' => array('static' => '', 'sticky' => 'fixed-top', 'floating' => 'floating-nav'),
            'verticalMenuNavbarType' => array('floating' => 'navbar-floating', 'static' => 'navbar-static', 'sticky' => 'navbar-sticky', 'hidden' => 'navbar-hidden'),
            'navbarClass' => array('floating' => 'floating-nav', 'static' => 'navbar-static-top', 'sticky' => 'fixed-top', 'hidden' => 'd-none'),
            'footerType' => array('static' => 'footer-static', 'sticky' => 'footer-fixed', 'hidden' => 'footer-hidden'),
            'pageHeader' => array(true, false),
            'contentLayout' => array('default', 'content-left-sidebar', 'content-right-sidebar', 'content-detached-left-sidebar', 'content-detached-right-sidebar'),
            'blankPage' => array(false, true),
            'sidebarPositionClass' => array('content-left-sidebar' => 'sidebar-left', 'content-right-sidebar' => 'sidebar-right', 'content-detached-left-sidebar' => 'sidebar-detached sidebar-left', 'content-detached-right-sidebar' => 'sidebar-detached sidebar-right', 'default' => 'default-sidebar-position'),
            'contentsidebarClass' => array('content-left-sidebar' => 'content-right', 'content-right-sidebar' => 'content-left', 'content-detached-left-sidebar' => 'content-detached content-right', 'content-detached-right-sidebar' => 'content-detached content-left', 'default' => 'default-sidebar'),
            'defaultLanguage' => array('en' => 'en', 'fr' => 'fr', 'de' => 'de', 'pt' => 'pt'),
            'direction' => array('ltr', 'rtl'),
        ];

        //if mainLayoutType value empty or not match with default options in custom.php config file then set a default value
        foreach ($allOptions as $key => $value) {
            if (array_key_exists($key, $DefaultData)) {
                if (gettype($DefaultData[$key]) === gettype($data[$key])) {
                    // data key should be string
                    if (is_string($data[$key])) {
                        // data key should not be empty
                        if (isset($data[$key]) && $data[$key] !== null) {
                            // data key should not be exist inside allOptions array's sub array
                            if (!array_key_exists($data[$key], $value)) {
                                // ensure that passed value should be match with any of allOptions array value
                                $result = array_search($data[$key], $value, 'strict');
                                if (empty($result) && $result !== 0) {
                                    $data[$key] = $DefaultData[$key];
                                }
                            }
                        } else {
                            // if data key not set or
                            $data[$key] = $DefaultData[$key];
                        }
                    }
                } else {
                    $data[$key] = $DefaultData[$key];
                }
            }
        }

        //layout classes
        $layoutClasses = [
            'theme' => $data['theme'],
            'layoutTheme' => $allOptions['theme'][$data['theme']],
            'sidebarCollapsed' => $data['sidebarCollapsed'],
            'showMenu' => $data['showMenu'],
            'layoutWidth' => $data['layoutWidth'],
            'verticalMenuNavbarType' => $allOptions['verticalMenuNavbarType'][$data['verticalMenuNavbarType']],
            'navbarClass' => $allOptions['navbarClass'][$data['verticalMenuNavbarType']],
            'navbarColor' => $data['navbarColor'],
            'horizontalMenuType' => $allOptions['horizontalMenuType'][$data['horizontalMenuType']],
            'horizontalMenuClass' => $allOptions['horizontalMenuClass'][$data['horizontalMenuType']],
            'footerType' => $allOptions['footerType'][$data['footerType']],
            'sidebarClass' => 'menu-expanded',
            'bodyClass' => $data['bodyClass'],
            'bodyStyle' => $data['bodyStyle'],
            'pageClass' => $data['pageClass'],
            'pageHeader' => $data['pageHeader'],
            'blankPage' => $data['blankPage'],
            'blankPageClass' => '',
            'contentLayout' => $data['contentLayout'],
            'sidebarPositionClass' => $allOptions['sidebarPositionClass'][$data['contentLayout']],
            'contentsidebarClass' => $allOptions['contentsidebarClass'][$data['contentLayout']],
            'mainLayoutType' => $data['mainLayoutType'],
            'defaultLanguage' => $allOptions['defaultLanguage'][$data['defaultLanguage']],
            'direction' => $data['direction'],
        ];
        // set default language if session hasn't locale value the set default language
        if (!session()->has('locale')) {
            app()->setLocale($layoutClasses['defaultLanguage']);
        }

        // sidebar Collapsed
        if ($layoutClasses['sidebarCollapsed'] == 'true') {
            $layoutClasses['sidebarClass'] = "menu-collapsed";
        }

        // blank page class
        if ($layoutClasses['blankPage'] == 'true') {
            $layoutClasses['blankPageClass'] = "blank-page";
        }

        return $layoutClasses;
    }
    public static function updatePageConfig($pageConfigs)
    {
        $demo = 'custom';
        $fullURL = request()->fullurl();
        if (App()->environment() === 'production') {
            for ($i = 1; $i < 7; $i++) {
                $contains = Str::contains($fullURL, 'demo-' . $i);
                if ($contains === true) {
                    $demo = 'demo-' . $i;
                }
            }
        }
        if (isset($pageConfigs)) {
            if (count($pageConfigs) > 0) {
                foreach ($pageConfigs as $config => $val) {
                    Config::set('custom.' . $demo . '.' . $config, $val);
                }
            }
        }
    }

    /**
     * Upload image to storage using Spatie\Image with specified quality.
     *
     * @param $image
     * <p>
     * The image file to be uploaded.
     * </p>
     * @param $img_path
     * <p>
     * The specified image upload path.
     * </p>
     * @param $options [optional]
     * <p>
     * image_width cuts the image to specified width, default false (image won't be cut).
     * image_quality set the image quality from 0 - 100, default 100.
     * thumbnail_path the specified thumbnail path, default false (thumbnail won't be created).
     * thumbnail_width cuts the thumbnail to specified width, default 500.
     * thumbnail_quality set the thumbnail quality from 0 - 100, default 100.
     * </p>
     *
     * @return string the uploaded image name
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public static function storeImage($image, string $img_path, array $options = []): string
    {
        $options = array_merge([
            'optimize' => true,
            'image_quality' => 100,
            'image_width' => 0,
            'thumbnail_path' => false,
        ], $options);
        $img_name = rand(1, 999) . time();
        $ext = $image->clientExtension();
        $img = Image::load($image->getRealPath());
        if ($options['optimize']) {
            $img->optimize()->quality($options['image_quality']);
        }
        if (!is_dir($img_path)) {
            (mkdir($img_path, 0755, true));
        }
        if ($options['image_width'] && $img->getWidth() > $options['image_width']) {
            $img->width($options['image_width']);
        }
        $img->save($img_path . $img_name . '.' . $ext);

        if ($options['thumbnail_path']) {
            static::createThumbnailsFromImage($img, $img_name, $ext, $options);
        }

        return $img_name . '.' . $ext;
    }

    public static function createThumbnailsFromImage(Image $img, string $img_name, string $ext, array $options)
    {
        $options = array_merge([
            'thumbnail_path' => false,
            'thumbnails' => [],
            'thumbnail_width' => 500,
            'thumbnail_height' => 0,
            'thumbnail_quality' => 100,
        ], $options);

        if (!is_dir($options['thumbnail_path'])) {
            (mkdir($options['thumbnail_path'], 0755, true));
        }
        if ($options['thumbnails']) {
            foreach ($options['thumbnails'] as $name => $thumbnail) {
                $thumbnail = array_merge(['width' => 500, 'height' => 0, 'quality' => 100], $thumbnail);
                if ($img->getWidth() > $thumbnail['width']) {
                    $img->width($thumbnail['width']);
                }
                if ($thumbnail['height'] && $img->getWidth() > $thumbnail['height']) {
                    $img->height($thumbnail['height']);
                }
                $img->quality($thumbnail['quality'])
                    ->save($options['thumbnail_path'] . $img_name . '_' . $name . '.' . $ext);
            }
        } else {
            if ($img->getWidth() > $options['thumbnail_width']) {
                $img->width($options['thumbnail_width']);
            }
            if ($options['thumbnail_height'] && $img->getWidth() > $options['thumbnail_height']) {
                $img->height($options['thumbnail_height']);
            }
            $img->quality($options['thumbnail_quality'])
                ->save($options['thumbnail_path'] . $img_name . '.' . $ext);
        }
    }

    // This function will return a random string of specified length
    public static function randomStrings($length_of_string, $alphanumeric = true)
    {
        // String of all alphanumeric character
        $str_result = $alphanumeric
            ? '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'
            : 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

    public static function getPortalDataLang()
    {
        return UserPreferences::getByKey('portal_data_lang') ?? config('app.fallback_locale');
    }

    public static function getCountryAndCityByGeoCordinate($latitude, $longitude, $locale)
    {
        $client = new GuzzleClient();
        $res = $client->get("https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=".$latitude."&longitude=".$longitude."&localityLanguage=".$locale);
        $status = $res->getStatusCode();
        if ($status != 200 ) {
            return [
                    'status' => $res->getStatusCode(),
                    'message' => 'Error while getting country name, status code:'.$status,
            ];
        }
        
        $geo_data = json_decode($res->getBody()->getContents());
        $country_name = $geo_data->countryName;
        $city_name = $geo_data->principalSubdivision;

        if (empty($country_name) || empty($city_name)) {
            return [
                    'status' => 404,
                    'message' => __('global.no_country_was_found'),
                ];
        }
        $country = Country::select([
                'countries.id',
            ])
            ->where('name','like',$country_name)
            ->first();

        if (!$country) {
            return [
                    'status' => 404,
                    'message' => __('global.country_was_not_found_in_db'),
                ];
        }

        $city = City::select([
            'cities.id',
        ])
        ->where('city_name','like',$city_name)
        ->first();

        if (!$city) {
            $city = City::create([
                'city_name' => $city_name,
                'city_name_ar' => $city_name,
                'city_name_tr' => $city_name,
                'country_id' => $country->id,
            ]);
        }

        return [
                'status' => 200,
                'message' => __('global.country_was_found_in_db'),
                'city'=> $city_name,
                'city_id'=> $city->id,
                'country_id' => $country->id,
                'country' => $country_name,
            ];
    }
}
