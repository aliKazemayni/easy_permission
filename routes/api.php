<?php

use Alikazemayni\EasyPermission\Http\Controllers\RoleController;
use Alikazemayni\EasyPermission\Http\Controllers\SectionController;
use Alikazemayni\EasyPermission\Http\Controllers\PermissionController;

Route::post('role/add_user',[RoleController::class , 'add_user']);
Route::post('role/remove_user',[RoleController::class , 'remove_user']);
Route::post('permission/user',[PermissionController::class, 'user']);

Route::apiResource('role' , RoleController::class);
Route::apiResource('section' , SectionController::class);
Route::apiResource('permission' , PermissionController::class);
