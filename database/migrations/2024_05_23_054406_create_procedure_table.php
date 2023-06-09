<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure ="DROP PROCEDURE IF EXISTS `get_users_by_id`;
            CREATE PROCEDURE `get_users_by_id` (IN inx int)
            BEGIN
                SELECT * FROM  users where id = inx;
            END;
        ";
        \DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedure');
    }
};
