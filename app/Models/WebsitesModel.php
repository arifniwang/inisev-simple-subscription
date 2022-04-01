<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class WebsitesModel extends Model
{
    use HasFactory;

    protected $table = 'websites';
    protected $fillable = ['domain'];

    public static function findByDomain($domain)
    {
        $cache_key = 'websites_' . $domain;

        if (Cache::get($cache_key)) {
            $data = Cache::get($cache_key);
        } else {
            $data = WebsitesModel::where('domain', '=', $domain)->first();
            Cache::put($cache_key, $data, 300); // 5 minutes
        }

        return $data;
    }
}
