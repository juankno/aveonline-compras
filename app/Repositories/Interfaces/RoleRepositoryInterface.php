<?php

namespace App\Repositories\interfaces;

interface RoleRepositoryInterface
{
    public function allRoles();

    public function storeRole($data);

    public function findRole($id);

    public function updateRole($data, $id);

    public function destroyRole($id);
}
