<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\City;
use App\Models\Config;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ConfigController extends Controller
{
    public function config()
    {
        $config = Config::first();
        $cities = City::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name')->get();

        return Response::api(__('message.Success'), 200, true, null, ['config' => $config, 'cities' => $cities]);
    }
    public function homePage()
    {
        $banners = Banner::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name', 'image')->get();
        $feeds = Feed::orderByDesc('created_at')->get();
        $categories = Category::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name', 'image', 'is_sport')
            ->orderBy('sort_order', 'asc')
            ->get();
        return Response::api(__('message.Success'), 200, true, null, ['banners' => $banners, 'feeds' => $feeds, 'categories' => $categories]);
    }
}
