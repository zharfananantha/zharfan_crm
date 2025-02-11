<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProductServices
{
    public static function get()
    {
        try {
            $products = Product::all();

            return (object)[
                'status' => 200,
                'message' => 'Product Get successful',
                'errors' => null,
                'data' => $products
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'message' => 'An error occurred while fetching products',
                'error' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public static function store($data)
    {
        try {
            DB::beginTransaction();
            
            if (isset($data['id'])) {
                // Jika ID ada, update produk yang sudah ada
                $product = Product::find($data['id']);
                if (!$product) {
                    return (object)[
                        'status' => 404,
                        'message' => 'Product not found',
                        'errors' => null,
                        'data' => null
                    ];
                }

                $product->update([
                    'name' => $data['name'],
                    'description' => $data['description'] ?? null,
                    'price' => $data['price'],
                ]);

                $message = 'Product updated successfully';
            } else {
                // Jika ID tidak ada, buat produk baru
                $product = Product::create([
                    'name' => $data['name'],
                    'description' => $data['description'] ?? null,
                    'price' => $data['price'],
                ]);

                $message = 'Product added successfully';
            }

            DB::commit();
            
            return (object)[
                'status' => 200,
                'message' => $message,
                'errors' => null,
                'data' => $product
            ];
        } catch (Exception $e) {
            DB::rollBack();
            
            return (object)[
                'status' => 500,
                'message' => 'An error occurred',
                'errors' => $e->getMessage(),
                'data' => null
            ];
        }
    }

}
