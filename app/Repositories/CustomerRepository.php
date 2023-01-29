<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function allCustomers()
    {
        return User::where('role_id', User::ROLES['customer'])->with('role')->latest()->paginate(10);
    }

    public function storeCustomer($data)
    {
        isset($data['password']) ? $data['password'] = bcrypt($data['password']) : '';
        $data['role_id'] = User::ROLES['customer'];
        return User::create($data);
    }

    public function findCustomer($id)
    {
        return User::where('role_id', User::ROLES['customer'])->with('role')->findOrFail($id);
    }

    public function updateCustomer($data, $id)
    {
        $customer = $this->findCustomer($id);
        isset($data['password']) ? $data['password'] = bcrypt($data['password']) : '';
        $customer->update($data);

        return $customer;
    }

    public function destroyCustomer($id)
    {
        $customer = $this->findCustomer($id);
        $customer->delete();
    }
}
