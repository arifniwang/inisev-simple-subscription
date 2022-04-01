<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Jobs\PostsEmailJob;
use App\Models\PostsModel;
use App\Models\SubscriberModel;
use App\Models\WebsitesModel;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function store(PostStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            // get data
            $websites = WebsitesModel::findByDomain($request->domain);

            // creat posts
            PostsModel::create([
                'websites_id' => $websites->id,
                'title' => $request->title,
                'description' => $request->description
            ]);

            // send email
            $subscriber = SubscriberModel::all()
                ->where('websites_id', '=', $websites->id)
                ->pluck('email')
                ->toArray();
            foreach ($subscriber as $i => $email) {
                dispatch(new PostsEmailJob([
                    'email' => $email,
                    'title' => $request->title,
                    'description' => $request->description
                ]));
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'messasge' => 'Success, Posts has been stored.'
            ], 200);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'status' => false,
                'messasge' => $e->getMessage()
            ], 500);
        }
    }
}
