<?php

// database/migrations/xxxx_xx_xx_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('address');
            $table->string('payment_method'); // Example: 'cash_on_delivery', 'gcash'
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['to pay', 'to ship', 'to receive', 'cancelled'])->default('to pay');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
