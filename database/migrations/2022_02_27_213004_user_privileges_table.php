<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $json = json_encode([
            'create_teams'=>0,
            'manage_all_users' => 0,
            'manage_all_teams' => 0,
        ]);

        Schema::create('user_privileges', function (Blueprint $table)use($json) {
            $table->id();
            $table->foreignId('user_id')->index()->unique();
            $table->string('privileges',800)->nullable()->default($json);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_privileges');
    }
}
