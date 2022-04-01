<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SubscriberModel extends Model
{
    use HasFactory;

    protected $table = 'subscriber';
    protected $fillable = ['websites_id', 'email'];

    public static function findByWebsitesAndEmail($websites_id, $email)
    {
        $cache_key = 'subscribe|' . $websites_id . '|' . $email;
        if (Cache::get($cache_key)) {
            $data = Cache::get($cache_key);
        } else {
            $data = SubscriberModel::where([
                'websites_id' => $websites_id,
                'email' => $email
            ])->first();
            Cache::put($cache_key, $data, 300); // 5 minutes
        }

        return $data;
    }

    public static function deleteByWebsitesAndEmail($websites_id, $email)
    {
        $cache_key = 'subscribe|' . $websites_id . '|' . $email;
        Cache::forget($cache_key);

        return SubscriberModel::where([
            'websites_id' => $websites_id,
            'email' => $email
        ])->delete();
    }
}
