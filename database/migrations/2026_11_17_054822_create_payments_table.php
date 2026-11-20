
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registration_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('order_id')->unique();
            $table->string('transaction_id')->nullable();

            $table->unsignedBigInteger('amount');

            $table->string('payment_status')
                ->default('pending');

            $table->string('payment_type')->nullable();

            $table->string('snap_token')->nullable();
            $table->text('payment_url')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->json('raw_response')->nullable();

            $table->timestamps();

            $table->index('payment_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
