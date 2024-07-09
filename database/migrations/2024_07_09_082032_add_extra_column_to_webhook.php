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
        Schema::table('webhooks', function (Blueprint $table) {
            $table->string("username")->nullable();
            $table->string("password")->nullable();
            $table->string("token_location")->nullable();
            $table->string("token_variable")->nullable();
            $table->string("token_value")->nullable();
            $table->string("signing_key")->nullable();
            $table->string("string_format")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('webhooks', function (Blueprint $table) {
            $table->dropColumn("username");
            $table->dropColumn("password");
            $table->dropColumn("token_location");
            $table->dropColumn("token_variable");
            $table->dropColumn("token_value");
            $table->dropColumn("signing_key");
            $table->dropColumn("string_format");
        });
    }
};
