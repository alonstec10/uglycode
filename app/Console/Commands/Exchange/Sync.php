<?php

namespace App\Console\Commands\Exchange;

use App\Library\Reader\Csv;
use App\Models\Polygon\Exchange;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Sync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle(): int
    {
        $files = glob( config('filesystems.disks.files.root') . '/Exchange/*.csv');

        $file = end($files);

        $reader = new Csv($file);
        $exchangeData = json_decode($reader->read(), true);


        foreach( $exchangeData as $exchange ) {

            if($this->exchangeExists($exchange['name'])) continue;

            $exchangeObj = new Exchange;
            array_map(function($key, $value) use($exchangeObj) {
                $exchangeObj->{$key} = $value;
            }, array_keys($exchange), array_values($exchange));
            $exchangeObj->save();
        }

        return CommandAlias::SUCCESS;
    }

    /**
     * @param $name
     * @return bool
     */
    private function exchangeExists( $name ): bool
    {
        return Exchange::where('name', '=', $name)->count() > 0;
    }


}
