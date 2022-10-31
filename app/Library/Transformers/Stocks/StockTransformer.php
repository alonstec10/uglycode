<?php
namespace App\Library\Transformers\Stocks;

use App\Library\Hydrators\Polygon\Stock;
use League\Fractal;

class StockTransformer extends  Fractal\TransformerAbstract
{

    /**
     * @param Stock $stock
     * @return array
     */
    public function transform( Stock $stock ): array
    {
        return [
            'id' => 1,
            'ticker' => $stock->getTicker(),
            'name' => $stock->getName(),
        ];
    }
}