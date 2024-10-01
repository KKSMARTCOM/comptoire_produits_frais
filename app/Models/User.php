<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword; // Import de l'interface correcte
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use LogsActivity;

    // Définir les attributs que vous souhaitez suivre
    protected static $logAttributes = ['name', 'email', 'is_admin'];

    // Nom du log personnalisé
    protected static $logName = 'user';

    /**
     * Définir une description personnalisée pour chaque log
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        $role = $this->isSuperAdmin() ? 'Super-Admin' : 'Admin';
        return "Le {$role} {$this->name} a réalisé une action de type {$eventName}";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'is_admin',
        'status',
        'avatar', // Nouveau champ ajouté
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->is_admin === 0;
    }

    public function isSuperAdmin()
    {
        return $this->is_admin === 1;
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'is_admin']) // Attributs à suivre
            ->setDescriptionForEvent(fn(string $eventName) => "L'utilisateur a été {$eventName}"); // Description pour chaque événement (création, mise à jour, suppression)
    }
}
