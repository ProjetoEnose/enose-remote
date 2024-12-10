<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Exceptions\PasswordMismatchException;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean', // Cast para booleano
    ];

    // Remover o incremento da chave primária
    public $incrementing = false;

    // Definir o tipo de chave primária como string
    protected $keyType = 'string';

    /* conceito de mutator */
    /*     public function setPasswordAttribute($value)
    {
        // Armazena o hash da senha em vez da senha em texto simples
        $this->attributes['password'] = Hash::make($value);
    }
 */
    public static function updatePasswordUser(array $passwords, User $user): bool
    {
        // Verifica se a senha atual está correta
        if (!$passwords['currentPassword'] === $user->password) {
            throw new PasswordMismatchException();
        }

        // Atualiza a senha do usuário com o novo hash
        $user->password = $passwords['newPassword'];

        // Salva as alterações no banco de dados
        return $user->save();
    }

    /**
     * Verifica se o usuário é administrador.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return (bool) $this->is_admin; // Converta para booleano
    }

    public function profileImage()
    {
        return $this->hasOne(ProfileImage::class);
    }
}
