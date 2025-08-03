<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'reg_number',
        'contact_name',
        'phone',
        'address',
        'approved',
        'cert_limit',
        'certificate_logo'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function adminPermission()
    {
        return $this->hasOne(AdminPermission::class);
    }

    /**
     * Check if user has permission to access a specific menu
     */
    public function hasMenuPermission($menuKey)
    {
        if (!$this->hasRole('admin')) {
            return false;
        }

        $permission = $this->adminPermission;
        if (!$permission) {
            // If no permission record exists, create a temporary super admin permission
            // This handles existing admin users who don't have permissions set up yet
            \App\Models\AdminPermission::create([
                'user_id' => $this->id,
                'menu_permissions' => [],
                'is_super_admin' => true
            ]);
            return true;
        }

        return $permission->hasMenuPermission($menuKey);
    }

    /**
     * Check if user is super admin
     */
    public function isSuperAdmin()
    {
        $permission = $this->adminPermission;
        return $permission ? $permission->is_super_admin : false;
    }
}
