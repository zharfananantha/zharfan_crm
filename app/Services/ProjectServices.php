<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\DB;

class ProjectServices
{
    public static function get()
    {
        try {
            $projects = Project::all();

            return (object)[
                'status' => 200,
                'message' => 'Projects Get successful',
                'errors' => null,
                'data' => $projects
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'message' => 'An error occurred while fetching projects',
                'error' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    public static function update($data)
    {
        try {
            DB::beginTransaction();

            $project = Project::find($data['id']);
            $lead = Lead::find($data['lead_id']);

            if (!$project) {
                return (object)[
                    'status' => 404,
                    'message' => 'Project not found',
                    'errors' => null,
                    'data' => null
                ];
            }

            if (!$lead) {
                return (object)[
                    'status' => 404,
                    'message' => 'Lead not found',
                    'errors' => null,
                    'data' => null
                ];
            }

            $lead->update([
                'status' => $data['status']
            ]);

            $project->update([
                'status' => $data['status']
            ]);

            if(strtolower($data['status']) == 'a') {
                Customer::create([
                    'name' => $lead->name,
                    'email' => $lead->email,
                    'phone' => $lead->phone,
                    'address' => $lead->address ?? null,
                    'product_id' => $lead->product_id,
                ]);
            }

            DB::commit();

            return (object)[
                'status' => 200,
                'message' => 'Project status update successful',
                'errors' => null,
                'data' => $project
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
