<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $fillable = [
        'user_id',
        'menu_permissions',
        'is_super_admin'
    ];

    protected $casts = [
        'menu_permissions' => 'array',
        'is_super_admin' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if user has permission to access a specific menu
     */
    public function hasMenuPermission($menuKey)
    {
        if ($this->is_super_admin) {
            return true;
        }

        return in_array($menuKey, $this->menu_permissions ?? []);
    }

    /**
     * Get all available menu options
     */
    public static function getAvailableMenus()
    {
        return [
            'dashboard' => 'Dashboard',
            'users' => 'College & Employer',
            'blog' => 'Blog Management',
            'certificates' => 'Certificates',
            'admin_management' => 'Admin Management'
        ];
    }
}