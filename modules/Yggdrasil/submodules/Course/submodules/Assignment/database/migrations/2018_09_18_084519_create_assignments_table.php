<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $table = 'assignments';

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
            $table->increments('id');
            $table->string('title');
            $table->string('code')->nullable();
            $table->text('feature')->nullable();
            $table->text('body')->nullable();
            $table->text('delta')->nullable();
            $table->datetime('deadline')->nullable();
            $table->integer('library_id')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('library_id')->references('id')->on('library');
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
