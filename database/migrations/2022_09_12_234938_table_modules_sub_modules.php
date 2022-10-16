<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableModulesSubModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('modules')){
            Schema::create('modules', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255)->unique();
                $table->string('text', 255)->unique();
                $table->timestamps();
            });
        }


        if(!Schema::hasTable('sub_modules')) {
            Schema::create('sub_modules', function (Blueprint $table) {
                $table->id();
                $table->foreignId('module_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->string('name', 255)->unique();
                $table->string('text', 255)->unique();
                $table->timestamps();

                $table->unique(['module_id', 'name']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_modules', function (Blueprint $table) {
            $table->dropForeign('sub_modules_module_id_foreign');
        });

        Schema::dropIfExists('modules');
        Schema::dropIfExists('sub_modules');
    }
}
