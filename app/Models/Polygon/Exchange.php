<?php

namespace App\Models\Polygon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsToMany;

/**
 * @method static where(string $string, string $string1, $name)
 */
class Exchange extends Model
{
    use HasFactory;


    protected $connection = 'mongodb';
    protected $collection = 'exchanges';
    protected $primaryKey = 'mic';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|BelongsToMany
     */
    public function tickers(): BelongsToMany|\Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tickers::class, null, 'primary_exchange', 'mic' );
    }


}
