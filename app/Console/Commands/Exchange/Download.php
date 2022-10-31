<?php

namespace App\Console\Commands\Exchange;

use App\Library\Entities\Exchange\All;
use App\Library\Writer\Csv;
use Illuminate\Console\Command;

class Download extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:download';

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
    public function handle()
    {

        $filePath = config('filesystems.disks.files.root') . '/Exchange/EXCHANGE_' . date("Y-m-d h:m:s") . '.csv';
        $writer = new Csv($filePath);
        $stocks = [];

        $exchanges = new All();
        try {
            $exchangeData = $exchanges->exec();
        } catch ( GuzzleHttp\Exception\ConnectException $clientException ) {
            dd("shit is dead");
        }


        $exchanges = $exchangeData['results'];

        $writer->setPreWrite(function( $currentWriter ) {
            $headers = array_keys(current($currentWriter->getData()));
            $currentWriter->writeLine($headers);
        });


        $writer->write($exchanges);

        echo "Total Exchanges written: " . count($exchanges) . "\n";

        return Command::SUCCESS;
    }
}
