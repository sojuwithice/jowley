<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In the migration file
public function up()
{
    Schema::table('ratings', function (Blueprint $table) {
        $table->unsignedBigInteger('order_item_id')->after('product_id');
        $table->foreign('order_item_id')->references('id')->on('order_items');
    });
}

public function down()
{
    Schema::table('ratings', function (Blueprint $table) {
        $table->dropForeign(['order_item_id']);
        $table->dropColumn('order_item_id');
    });
}
};
