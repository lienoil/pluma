<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Phinx\Migration\AbstractMigration;
use Pluma\Support\Migration\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * The table name.
     *
     * @var string
     */
    protected $tablename = 'announcements';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create($this->tablename, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->text('body')->nullable();
            $table->text('delta')->nullable();
            $table->timestamp('published_at')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('expired_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists($this->tablename);
    }
}
