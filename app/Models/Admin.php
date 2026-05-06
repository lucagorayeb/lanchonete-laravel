<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Model de funcionários da lanchonete MecDonin.
 *
 * Separado do Model User (clientes) para garantir isolamento total
 * de autenticação via guard 'admin'. As roles disponíveis são:
 *   - Admin   : acesso irrestrito ao painel
 *   - Gerente : gerencia produtos, pedidos e relatórios
 *   - Caixa   : apenas visualiza e processa pedidos
 *
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property string $password
 */
class Admin extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;

    /**
     * O guard_name é OBRIGATÓRIO para o Spatie vincular
     * as roles ao guard correto ('admin'), nunca ao 'web'.
     *
     * Sem isso, o Spatie tentaria usar o guard padrão ('web')
     * e as roles não funcionariam para os funcionários.
     */
    protected string $guard_name = 'admin';

    /**
     * Tabela de funcionários no banco de dados.
     */
    protected $table = 'admins';

    /**
     * Atributos que podem ser preenchidos via mass assignment.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Atributos ocultos na serialização (JSON de API, etc.).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts de atributos do Eloquent.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
}
