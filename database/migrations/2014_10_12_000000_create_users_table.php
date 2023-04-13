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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            
            $table->string('tc_kimlik_no');
            $table->string('vergi_kimlik_no');
            $table->string('sirket_adi')->nullable();
            $table->string('telefon')->nullable();
            $table->string('faks')->nullable();
            $table->string('adres')->nullable();
            $table->string('edm_service_user')->nullable();
            $table->string('edm_service_pass')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
