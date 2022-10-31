<?php

namespace App\Console\Commands\Stocks;

use App\Library\Entities\Stocks\All;
use App\Library\Mapper\Polygon\Stocks\All as AllMapper;
use App\Library\Writer\Csv;
use App\Library\Writer\Writer;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Download extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is to sync stocks to a database';


    protected Writer $writer;


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
     * @throws Exception
     * @throws GuzzleException
     */
    public function handle()
    {
        $filePath = config('filesystems.disks.files.root') . '/STOCKS_' . date("Y-m-d h:m:s") . '.csv';
        $this->writer = new Csv($filePath);
        $stocks = [];

        $this->getNextStocks($stocks, '', 0);

        echo "Total Tickers written: " . count($stocks) . "\n";


        return CommandAlias::SUCCESS;
    }

    /**
     * @throws Exception
     * @throws GuzzleException
     */
    public function getNextStocks(&$stocks, $cursor = '', $cnt = 0 )
    {
        $mapper = new AllMapper();
        $stockEntity = new All( $mapper, $mapper->map(), $cursor );

        try {
            $stockData = $stockEntity->exec();
        } catch ( GuzzleHttp\Exception\ConnectException $clientException ) {
            dd("shit is dead");
        }

        $stocks = array_merge($stocks, $stockData['results']);

        if($cnt == 0) {
            //lets get headers
            $this->writer->setPreWrite(function( $currentWriter ) {
                $headers = array_keys(current($currentWriter->getData()));
                $currentWriter->writeLine($headers);
            });
        } else {
            $this->writer->setPreWrite(null);
        }
        $this->writer->write($stocks);

        if( isset($stockData['next_url']) && $nextUrl = $stockData['next_url']) {
            $cnt++;
            return $this->getNextStocks($stocks, $nextUrl, $cnt);
        }
    }



}
