<?php

namespace Alikazemayni\EasyPermission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class,'section_id' , 'id');
    }

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission',
            'permissions_id', 'role_id')->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
