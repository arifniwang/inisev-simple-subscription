<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebsiteRegistrationRequest;
use App\Models\WebsitesModel;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
    public function registration(WebsiteRegistrationRequest $request)
    {
        DB::beginTransaction();
        try {
            $find = WebsitesModel::findByDomain($request->domain);

            if ($find) {
                $response = response()->json([
                    'status' => false,
                    'messasge' => 'Domain has been registered.'
                ], 400);
            } else {
                // save data
                WebsitesModel::create([
                    'domain' => $request->domain
                ]);

                $response = response()->json([
                    'status' => true,
                    'messasge' => 'Registered domain successfully.'
                ], 200);
            }

            DB::commit();
            return $response;
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'status' => false,
                'messasge' => $e->getMessage()
            ], 500);
        }
    }
}
