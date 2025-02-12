<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Exception;

class LeadServices
{
    public static function get()
    {
        try {
            $leads = Lead::all();

            return (object)[
                'status' => 200,
                'message' => 'Leads Get successful',
                'errors' => null,
                'data' => $leads
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'message' => 'An error occurred while fetching leads',
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
                $lead = Lead::find($data['id']);
                if (!$lead) {
                    return (object)[
                        'status' => 404,
                        'message' => 'Lead not found',
                        'errors' => null,
                        'data' => null
                    ];
                }

                $lead->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'address' => $data['address'] ?? null,
                    'product_id' => $data['product_id'],
                ]);

                $project = Project::where('lead_id', $data['id'])->first();
                if (!$project) {
                    return (object)[
                        'status' => 404,
                        'message' => 'Project not found',
                        'errors' => null,
                        'data' => null
                    ];
                }
                $project->update([
                    'lead_id' => $lead->id,
                    'product_id' => $data['product_id'],
                    'status' => $project->status,
                ]);

                $message = 'Lead updated successfully';
            } else {
                // Jika ID tidak ada, buat produk baru
                $lead = Lead::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'address' => $data['address'] ?? null,
                    'product_id' => $data['product_id'],
                ]);

                $project = Project::create([
                    'lead_id' => $lead->id,
                    'product_id' => $data['product_id'],
                    'status' => 'p'
                ]);

                $message = 'Lead added successfully';
            }

            DB::commit();
            
            return (object)[
                'status' => 200,
                'message' => $message,
                'errors' => null,
                'data' => $lead
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
    
    public static function delete($id)
    {
        try {
            DB::beginTransaction();
    
            $lead = Lead::find($id);
    
            if (!$lead) {
                return (object)[
                    'status' => 404,
                    'message' => 'Lead not found',
                    'errors' => null,
                    'data' => null
                ];
            }
    
            $lead->delete();
            DB::commit();
    
            return (object)[
                'status' => 200,
                'message' => 'Lead deleted successfully',
                'errors' => null,
                'data' => null
            ];
        } catch (Exception $e) {
            DB::rollBack();
    
            return (object)[
                'status' => 500,
                'message' => 'An error occurred while deleting the Lead',
                'errors' => $e->getMessage(),
                'data' => null
            ];
        }
    }
    

}
