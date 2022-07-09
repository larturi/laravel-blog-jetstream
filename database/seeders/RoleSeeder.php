<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Blogger']);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver Dashboard'])->syncRoles([$role1, $role2]);

        // Solo Amin puede administrar Users
        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Editar Usuarios'])->syncRoles([$role1]);

        // Solo Amin puede administrar Roles
        Permission::create(['name' => 'admin.roles.index', 'description' => 'Ver Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit', 'description' => 'Editar Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.update', 'description' => 'Actualizar Roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Eliminar Roles'])->syncRoles([$role1]);

        // Solo Amin puede administrar Categories
        Permission::create(['name' => 'admin.categories.create', 'description' => 'Crear Categorias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit', 'description' => 'Editar Categorias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy', 'description' => 'Eliminar Categorias'])->syncRoles([$role1]);
        // Admin y Blogger pueden ver Categories
        Permission::create(['name' => 'admin.categories.index', 'description' => 'Ver Categorias'])->syncRoles([$role1, $role2]);

        // Solo Amin puede administrar Tags
        Permission::create(['name' => 'admin.tags.create', 'description' => 'Crear Tags'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit', 'description' => 'Editar Tags'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy', 'description' => 'Eliminar Tags'])->syncRoles([$role1]);
        // Admin y Blogger pueden ver Tags
        Permission::create(['name' => 'admin.tags.index', 'description' => 'Ver Tags'])->syncRoles([$role1, $role2]);

        // Admin y Bloggers pueden administrar Posts
        Permission::create(['name' => 'admin.posts.index', 'description' => 'Ver Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.create', 'description' => 'Crear Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit', 'description' => 'Editar Posts'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy', 'description' => 'Eliminar Posts'])->syncRoles([$role1, $role2]);
    }
}
