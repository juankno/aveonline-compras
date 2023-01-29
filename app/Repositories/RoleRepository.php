<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function allRoles()
    {
        return Role::latest()->paginate(10);
    }

    public function storeRole($data)
    {
        return Role::create($data);
    }

    public function findRole($id)
    {
        return Role::findOrFail($id);
    }

    public function updateRole($data, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $data['name'];
        $role->save();
    }

    public function destroyRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
