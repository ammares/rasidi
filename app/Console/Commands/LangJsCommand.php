<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session;

class LangJsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:js';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate JS lang files.';

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
        $languages = config('translatable.locales');
        $strings = [];
        foreach ($languages as $lang) {
            $files = glob(resource_path('lang/' . $lang . '/*.php'));
            foreach ($files as $file) {
                $name = basename($file, '.php');
                $strings[$lang . '.' . $name] = require $file;
            }
        }
        $script = file_get_contents(public_path('js/custom/common/lang.js'));
        $script .= "(function () {
    Lang = new Lang();
    Lang.setMessages(" . json_encode($strings) . ");
        })();";

        $fileName = public_path('js/messages.js');
        file_put_contents($fileName, $script);
        $this->info('messages file created successfully');

        return 0;
    }
}
