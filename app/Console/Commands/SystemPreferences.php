<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class SystemPreferences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:system-preferences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate/Update system preferences config file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $preferences = \App\Models\SystemPreference::pluck('value', 'key')->toArray();
        $preferences_string = "[\n";
        foreach ($preferences as $key => $preference) {
            $preferences_string .= "\t'" . $key . "' => '" . str_replace("'", '&apos;', $preference) . "',\n";
        }
        $preferences_string .= ']';
        $system_preferences_config_file = fopen(config_path('system-preferences.php'), 'w');
        fwrite($system_preferences_config_file, "<?php \nreturn " . $preferences_string . ';');

        if (in_array(App::environment(), ['production', 'testing'])) {
            Artisan::call('optimize');
        }

        $this->info('Completed Successfully');
    }
}
