<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Seeder de Funcionários e Roles do MecDonin.
 *
 * Cria as 3 roles atreladas ao guard 'admin' e o primeiro
 * administrador do sistema. Execute com:
 *   php artisan db:seed --class=AdminSeeder
 *
 * ⚠️  Troque a senha do admin@mecdonin.com no primeiro login!
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================
        // 1. CRIAR AS ROLES (guard 'admin' obrigatório)
        // =====================================================

        // Acesso irrestrito: gerencia tudo no painel
        $roleAdmin = Role::firstOrCreate([
            'name'       => 'Admin',
            'guard_name' => 'admin',
        ]);

        // Gerencia produtos, pedidos e relatórios
        $roleGerente = Role::firstOrCreate([
            'name'       => 'Gerente',
            'guard_name' => 'admin',
        ]);

        // Apenas visualiza e processa pedidos no caixa
        $roleCaixa = Role::firstOrCreate([
            'name'       => 'Caixa',
            'guard_name' => 'admin',
        ]);

        // =====================================================
        // 2. CRIAR O PRIMEIRO ADMINISTRADOR
        // =====================================================

        $admin = Admin::firstOrCreate(
            ['email' => 'admin@mecdonin.com'],
            [
                'name'     => 'Super Admin',
                'password' => bcrypt('MecDonin@2026!'), // ⚠️ Trocar no primeiro login
            ]
        );

        $admin->assignRole($roleAdmin);

        // =====================================================
        // 3. CRIAR UM GERENTE DE EXEMPLO (opcional)
        // =====================================================

        $gerente = Admin::firstOrCreate(
            ['email' => 'gerente@mecdonin.com'],
            [
                'name'     => 'Gerente Exemplo',
                'password' => bcrypt('Gerente@2026!'), // ⚠️ Trocar no primeiro login
            ]
        );

        $gerente->assignRole($roleGerente);

        $this->command->info('Roles criadas: Admin, Gerente, Caixa (guard: admin)');
        $this->command->info('Admin: admin@mecdonin.com');
        $this->command->info('Gerente: gerente@mecdonin.com');
        $this->command->warn('Lembre-se de trocar as senhas no primeiro login!');
    }
}
