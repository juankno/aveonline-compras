<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Repositories\interfaces\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class OrderRepository implements OrderRepositoryInterface
{
    public function allOrders()
    {
        $user = auth()->user();

        return Order::with('customer', 'products')
            ->when($user->role_id == User::ROLES['customer'], function ($query) use ($user) {
                $query->where('customer_id', $user->id);
            })
            ->when($user->role_id == User::ROLES['user'], function ($query) use ($user) {
                $query->whereHas('products', function (Builder $product) use ($user) {
                    $product->where('user_id', $user->id);
                });
            })
            ->latest()
            ->paginate(10);
    }

    public function storeOrder($data)
    {
        $data['customer_id'] = auth()->id();
        $data['quantity_products'] = count($data['products']) ?? 0;
        $order = Order::create($data);

        $order->products()->sync($data['products']);

        return $order;
    }

    public function findOrder($id)
    {
        return Order::with('customer', 'products')->findOrFail($id);
    }

    public function updateOrder($data, $id)
    {
        $order = $this->findOrder($id);
        $data['quantity_products'] = count($data['products']) ?? 0;
        $order->products()->sync($data['products']);
        $order->update($data);

        return $order;
    }

    public function destroyOrder($id)
    {
        $order = $this->findOrder($id);
        $order->products()->detach();
        $order->delete();
    }
}
