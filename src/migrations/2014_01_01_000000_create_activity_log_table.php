<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer(Config::get('activity-log-saas::key'));
            $table->integer('user_id');
            $table->integer('content_id');
            $table->string('content_type', 72);
            $table->string('action', 32);
            $table->string('description');
            $table->text('details');
            $table->boolean('developer');
            $table->string('ip_address', 64);
            $table->string('user_agent');
            $table->timestamps();
        });

        Schema::table('activity_logs', function($table)
        {

            // We'll need to ensure that MySQL uses the InnoDB engine to
            // support the indexes, other engines aren't affected.
            $table->engine = 'InnoDB';
            // Useful for filters
            $table->index('user_id');
            $table->index('content_id');
            $table->index('content_type');
            $table->index('action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity_logs');
    }

}
