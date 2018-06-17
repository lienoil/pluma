<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonstreeTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'lessonstree';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->integer('ancestor')->unsigned();
            $table->integer('descendant')->unsigned();
            $table->integer('sort')->default(0);
            $table->integer('length')->default(0);

            $table->index(['ancestor', 'descendant']);

            $table->foreign('ancestor')
                  ->references('id')
                  ->on('lessons')
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');

            $table->foreign('descendant')
                  ->references('id')
                  ->on('lessons')
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
