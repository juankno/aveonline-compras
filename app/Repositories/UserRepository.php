<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        return User::with('role')->latest()->paginate(10);
    }

    public function storeUser($data)
    {
        isset($data['password']) ? $data['password'] = bcrypt($data['password']) : '';
        return User::create($data);
    }

    public function findUser($id)
    {
        return User::with('role')->findOrFail($id);
    }

    public function updateUser($data, $id)
    {
        $user = $this->findUser($id);
        isset($data['password']) ? $data['password'] = bcrypt($data['password']) : '';
        $user->update($data);

        return $user;
    }

    public function destroyUser($id)
    {
        $user = $this->findUser($id);
        $user->delete();
    }
}
