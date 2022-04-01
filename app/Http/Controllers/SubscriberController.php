<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\SubscriberModel;
use App\Models\WebsitesModel;
use Illuminate\Support\Facades\DB;

class SubscriberController extends Controller
{
    public function store(SubscribeRequest $request)
    {
        DB::beginTransaction();
        try {
            // get data
            $websites = WebsitesModel::findByDomain($request->domain);
            $find = SubscriberModel::findByWebsitesAndEmail($websites->id, $request->email);

            // create new data
            if (!$find) {
                SubscriberModel::create([
                    'websites_id' => $websites->id,
                    'email' => $request->email
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'messasge' => 'Success, You\'re now subscribed.'
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'status' => false,
                'messasge' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(SubscribeRequest $request)
    {
        DB::beginTransaction();
        try {
            // get data
            $websites = WebsitesModel::where('domain', '=', $request->domain)->first();
            $find = SubscriberModel::findByWebsitesAndEmail($websites->id, $request->email);

            if (!$find) {
                $response = response()->json([
                    'status' => false,
                    'messasge' => 'Failed, You\'re not subscribed.'
                ], 400);
            } else {
                // delete data
                SubscriberModel::deleteByWebsitesAndEmail($websites->id, $request->email);

                $response = response()->json([
                    'status' => true,
                    'messasge' => 'Success, Unsubscribe successfully.'
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
