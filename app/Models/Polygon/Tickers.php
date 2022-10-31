<?php

namespace App\Models\Polygon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @method static where(string $string, string $string1, $ticker)
 */
class Tickers extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'stocks';


}
