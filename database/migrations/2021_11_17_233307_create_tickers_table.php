<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTickersTable extends Migration
{

    protected $connection = 'mongodb';

    private string $collectionName = 'stocks';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->collectionName, function (Blueprint $table) {

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->collectionName);
    }
}
