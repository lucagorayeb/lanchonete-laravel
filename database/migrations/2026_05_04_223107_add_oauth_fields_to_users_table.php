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
        Schema::table('users', function (Blueprint $table) {
            // Permite que a senha seja nula (usuários que só usam OAuth)
            $table->string('password')->nullable()->change();

            // Provedor OAuth: 'google', 'facebook' ou null (cadastro manual)
            $table->string('provider')->nullable()->after('email');

            // ID único do usuário no provedor (ex: ID do Google)
            $table->string('provider_id')->nullable()->after('provider');

            // URL do avatar vindo do provedor
            $table->string('avatar')->nullable()->after('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['provider', 'provider_id', 'avatar']);
            $table->string('password')->nullable(false)->change();
        });
    }
};
