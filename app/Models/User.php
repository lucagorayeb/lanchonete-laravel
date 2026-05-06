<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model de clientes do site MecDonin (guard 'web').
 *
 * Separado do Model Admin (funcionários) para isolamento total de autenticação.
 * Suporta cadastro manual (email + senha) e OAuth2 (Google, Facebook).
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string|null $provider      ex: 'google', 'facebook'
 * @property string|null $provider_id   ID do usuário no provedor OAuth
 * @property string|null $avatar        URL da foto de perfil do provedor
 * @property string|null $password      Null quando o usuário só usa OAuth
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atributos que podem ser preenchidos via mass assignment.
     * Inclui os campos OAuth para permitir criação via Socialite.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'avatar',
    ];

    /**
     * Atributos ocultos na serialização.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts de atributos.
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

