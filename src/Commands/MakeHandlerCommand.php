<?php

namespace SoheilY98\TelegramBot\Commands;

use Illuminate\Console\Command;

class MakeHandlerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:handler
                            {name : The Handler\'s Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes Telegram Bot Request Handler.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $className = ucfirst($this->argument('name'));

        if (!is_dir($directory = app_path('/Telegram/Handlers/'))) {
            mkdir($directory, 0755, true);
        }

        $handlerPath = $this->getHandlerPath($className);
        if (!file_exists($className)) {
            $file = file_get_contents(__DIR__ . '/../../assets/BaseHandler.tmpl');
            $file = preg_replace('/%CLASS_NAME%/', ucfirst($className), $file);
            $file = preg_replace('/%NAMESPACE%/', app()->getNamespace() . "Telegram\Handlers" , $file);
            file_put_contents($handlerPath, $file);
        }
    }

    private function getHandlerPath($className)
    {
        return app_path('/Telegram/Handlers/') . $className . '.php';
    }
}
