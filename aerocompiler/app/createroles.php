<?php

use Bican\Roles\Models\Role;

$superAdminRole = Role::create([
    'name' => 'Super Admin',
    'slug' => 'super.admin',
    'description' => '', // optional
    'level' => 3,
]);

$adminRole = Role::create([
'name' => 'Admin',
'slug' => 'admin',
'description' => '', // optional
'level' => 2, // optional, set to 1 by default
]);

$examinerRole = Role::create([
'name' => 'Examiner',
'slug' => 'examiner',
'level' => 1,
]);


