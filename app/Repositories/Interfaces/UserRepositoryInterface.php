<?php

namespace App\Repositories\interfaces;

interface UserRepositoryInterface
{
    public function allUsers();

    public function storeUser($data);

    public function findUser($id);

    public function updateUser($data, $id);

    public function destroyUser($id);
}
