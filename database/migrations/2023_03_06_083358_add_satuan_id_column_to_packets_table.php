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
        Schema::table('packets', function (Blueprint $table) {
            $table->unsignedBigInteger('satuan_id')->after('weight');
            $table->foreign('satuan_id')->references('id')->on('units')->OnDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packets', function (Blueprint $table) {
            if (Schema::hasColumn('packets', 'satuan_id')) {
                $table->dropForeign(['satuan_id']);
                $table->dropColumn('satuan_id');
            }
        });
    }
};
