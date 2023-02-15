<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\User;
use App\Repositories\interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function allProducts()
    {
        return Product::with('user')
            ->when(User::ROLES['user'] == auth()->user()->role_id, function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->latest()
            ->paginate(10);
    }

    public function storeProduct($data)
    {
        $data['user_id'] = auth()->id();

        return Product::create($data);
    }

    public function findProduct($id)
    {
        return Product::with('user')->findOrFail($id);
    }

    public function updateProduct($data, $id)
    {
        $product = $this->findProduct($id);
        $product->update($data);

        return $product;
    }

    public function destroyProduct($id)
    {
        $product = $this->findProduct($id);
        $product->delete();
    }
}
