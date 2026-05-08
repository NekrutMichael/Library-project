<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id(); // Первинний ключ
            $table->string('name'); // Ім'я відправника
            $table->string('email'); // Пошта відправника
            $table->text('message'); // Текст повідомлення
            $table->timestamps(); // Автоматично створює поля created_at та updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};