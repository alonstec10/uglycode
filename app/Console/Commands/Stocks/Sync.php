<?php

namespace App\Console\Commands\Stocks;

use App\Library\Reader\Csv;
use App\Models\Polygon\Tickers;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Sync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync stocks to a mongo database';

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
        $files = glob( config('filesystems.disks.files.root') . '/*.csv');

        $file = end($files);


        $reader = new Csv($file);
        $stockData = json_decode($reader->read(), true);

        foreach( $stockData as $stock) {

            if($this->stockExists($stock['ticker'])) continue;

            $ticker = new Tickers;
            array_map(function($key, $value) use($ticker) {
                $ticker->{$key} = $value;
            }, array_keys($stock), array_values($stock));
            $ticker->save();
        }

        return CommandAlias::SUCCESS;
    }

    /**
     * @param $ticker
     * @return bool
     */
    private function stockExists( $ticker ): bool
    {
        return Tickers::where('ticker', '=', $ticker)->count() > 0;
    }

}
