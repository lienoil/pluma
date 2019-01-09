<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlMenusTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->table, function ($table) {
            $table->string('url')->after('location');
            $table->index(['url']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->table, function ($table) {
            $table->dropColumn('url');
        });
    }
}
