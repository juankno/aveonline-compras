<?php

namespace App\Repositories\interfaces;

interface OrderRepositoryInterface
{
    public function allOrders();

    public function storeOrder($data);

    public function findOrder($id);

    public function updateOrder($data, $id);

    public function destroyOrder($id);
}
