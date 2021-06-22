<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{

    private $path;
    private $array_lang = array();

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routeList = app('router')->getRoutes();
        $routes = [];
        $languages = config('translatable.locales');
       
        foreach ($routeList as $route) {
            $routeName = (string) $route->getName();

            if ('' != $routeName
                // ignore some route names...
                && false === strpos($routeName, 'debugbar.')
                && false === strpos($routeName, 'emails.')
                && false === strpos($routeName, 'email.')
                && false === strpos($routeName, 'passport.')
                && false === strpos($routeName, 'lang.')
                && $routeName !== 'login'
                && $routeName !== 'logout'
            ) {
                $routes[] = $routeName;
            }
        }
        foreach ($routes as $route) {
            Permission::updateOrCreate(['name' => $route, 'guard_name' => 'web']);
        }
        foreach ($languages as $lang) {
            $this->path = base_path().'/resources/lang/'.$lang.'/permissions.php';

            if (file_exists(base_path().'/resources/lang/'.$lang.'/')) {
                $this->read($lang);
                
                foreach ($routes as $route) {
                    $key = str_replace('.', '_', $route);
                    $value = $key;
                    if (!array_key_exists($key, $this->array_lang)) {
                        $this->array_lang[$key] = $value;
                    }
                }
                $this->save();
            }
        }
    }

    private function read($lang) 
    {
        $this->array_lang = __('permissions',[],$lang);
        if (gettype($this->array_lang) == 'string') $this->array_lang = array();
    }

    private function save() 
    {
        $content = "<?php\n\nreturn\n[\n";
        foreach ($this->array_lang as $this->key => $this->value) {
            $content .= "\t'".$this->key."' => '".$this->value."',\n";
        }
        $content .= "];";
        file_put_contents($this->path, $content);
    }
}
