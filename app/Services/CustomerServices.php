<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\DB;

class CustomerServices
{
    public static function get()
    {
        try {
            $customers = Customer::all();

            return (object)[
                'status' => 200,
                'message' => 'Customers Get successful',
                'errors' => null,
                'data' => $customers
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'message' => 'An error occurred while fetching customers',
                'error' => $e->getMessage(),
                'data' => null
            ];
        }
    }
}
