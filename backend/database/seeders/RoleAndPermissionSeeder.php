<?php

namespace Database\Seeders;

use App\Enums\Permission as PermissionEnum;
use App\Enums\Role as RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (PermissionEnum::cases() as $permission) {
            Permission::create(['name' => $permission->value]);
        }

        foreach (RoleEnum::cases() as $role) {
            $role = Role::create(['name' => $role->value]);
            $this->givePermissionsToRole($role);
        }
    }

    private function givePermissionsToRole(Role $role): void
    {
        $permissions = [];
        switch ($role->name) {
            case RoleEnum::EDITOR->value:
                $permissions = [
                    PermissionEnum::ACCESS_ADMIN,
                    PermissionEnum::ACCESS_PRODUCT,
                    PermissionEnum::CREATE_PRODUCT,
                    PermissionEnum::EDIT_PRODUCT,
                    PermissionEnum::DELETE_PRODUCT,
                    PermissionEnum::VIEW_PRODUCT,
                ];
                break;
            case RoleEnum::CUSTOMER:
                $permissions = [
                    PermissionEnum::VIEW_PRODUCT
                ];
                break;
        }

        $role->syncPermissions($permissions);
    }
}
