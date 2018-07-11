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
            $table->integer('ancestor_id')->unsigned();
            $table->integer('descendant_id')->unsigned();
            $table->integer('depth')->default(0);

            $table->index(['ancestor_id', 'descendant_id']);

            $table->foreign('ancestor_id')
                  ->references('id')
                  ->on('lessons')
                  ->onUpdate('CASCADE')
                  ->onDelete('CASCADE');

            $table->foreign('descendant_id')
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
