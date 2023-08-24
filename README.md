<h1 align="center">easy_permission</h1>
<p align="center"> description : This package is for creating a simple authentication system in laravel </p>

---

### Install package :

```shell
  composer require alikazemayni/easy_permission
```

### Publish files :

```shell
  php artisan vendor:publish --tag publish-permissions-file
```

### Migrate :

```shell
  php artisan migrate
```

---

### User relation :

```php
public function permissions(): BelongsToMany
{
    $this->belongsToMany(Permission::class, 'user_permission',
        'user_id', 'permissions_id')->withTimestamps();
}
```

### Get all permission and user permission :

```php
    ResponderFacade::setData(
        Permissions::with(
            ['users' => fn($q) => $q->where('user_id' , $request->user_id),'section']
        )
        ->get()
    )->respond();
```

### Sync user permission :

```php
public function user(Request $request): JsonResponse{
    $permissions = User::findOrFail($request->user_id)->permissions();
    $permissions->sync($request->permissions);
}
```

---

### Add user from role :

```php
    $role_permission = Role::findOrFail($request->role_id)->permissions->pluck('id');
    if ($request->force)
        User::findOrFail($request->user_id)->permissions()
            ->wherePivot('type', 'role')->delete();
    User::findOrFail($request->user_id)->permissions()
        ->syncWithPivotValues($role_permission, ['type' => 'role']);
    Role::findOrFail($request->role_id)->users()->attach($request->user_id);
```

### Remove user from role

```php
    User::findOrFail($request->user_id)->permissions()->wherePivot('type', 'role')->detach();
    Role::findOrFail($request->role_id)->users()
        ->wherePivot('user_id', $request->user_id)->detach();
```
