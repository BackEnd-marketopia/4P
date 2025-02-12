<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FormPlayer\FormPlayerRequest;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Feed;
use App\Models\PlayerForm;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        if ($request->type == 'vendor') {
            $user = auth('api')->user();
            $vendors = $user ? Vendor::where('status', 'accepted')
                ->whereJsonContains('citys_id', (string)$user->city_id)
                ->where('name', 'like',  '%' . $request->search . '%')
                ->when($request->catId, function ($query) use ($request) {
                    return $query->where('category_id', $request->catId);
                })
                ->get(['id', 'name', 'logo', 'description']) :
                Vendor::where('status', 'accepted')
                ->where('name', 'like',  '%' . $request->search . '%')
                ->when($request->catId, function ($query) use ($request) {
                    return $query->where('category_id', $request->catId);
                })
                ->orderByDesc('created_at')
                ->take(40)->get(['id', 'name', 'logo', 'description']);
            return Response::api(__('message.Success'), 200, true, null, ['vendors' => $vendors]);
        } elseif ($request->type == 'discount') {
            $discount = Discount::where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->where('title', 'like',  '%' . $request->search . '%')
                ->orWhere('description', 'like',  '%' . $request->search . '%')
                ->get();
            return Response::api(__('message.Success'), 200, true, null, ['discounts' => $discount]);
        }
    }

    public function playerForm(FormPlayerRequest $request)
    {
        $images = null;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image)
                $images[] = Helpers::addImage($image, 'player_form');
        }

        $user = auth('api')->user();
        if ($user->playerForm)
            return Response::api(__('message.You have already submitted a form'), 400, false, 400);

        $player_form = PlayerForm::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'age' => $request->age,
            'name_of_old_club' => $request->name_of_old_club ?? null,
            'name_of_current_club' => $request->name_of_current_club ?? null,
            'job_of_parent' => $request->job_of_parent ?? null,
            'long_life_desises' => $request->long_life_desises ?? null,
            'injuries' => $request->injuries ?? null,
            'images' => !empty($images) ? json_encode($images) : null,
            'city_name' => $request->city_name,
            'user_id' => auth('api')->id(),
        ]);
        $player_form->images = json_decode($player_form->images);
        return Response::api(__('message.Success'), 200, true, null, ['player_form' => $player_form]);
    }


    public function vendorsByCategoryId($category_id)
    {
        $user = auth('api')->user();
        $vendors = $user ? Vendor::where('category_id', $category_id)
            ->where('status', 'accepted')
            ->whereJsonContains('citys_id', (string)$user->city_id)
            ->get(['id', 'name', 'logo', 'description']) :
            Vendor::where('category_id', $category_id)
            ->where('status', 'accepted')
            ->orderByDesc('created_at')
            ->take(40)->get(['id', 'name', 'logo', 'description']);

        return Response::api(__('message.Success'), 200, true, null, ['vendors' => $vendors]);
    }

    public function vendorDetails($id)
    {
        $vendor = Vendor::findOrFail($id);
        $discounts = $vendor->discounts()->where('start_date', '<=', now())->where('end_date', '>=', now())->get();
        return Response::api(__('message.Success'), 200, true, null, ['vendor' => $vendor, 'discounts' => $discounts]);
    }

    public function categories()
    {
        $categories = Category::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name', 'image', 'is_sport')
            ->orderBy('sort_order', 'asc')
            ->get();
        return Response::api(__('message.Success'), 200, true, null, ['categories' => $categories]);
    }

    public function feeds()
    {
        $feeds = Feed::orderByDesc('created_at')->paginate(20);

        $data = collect($feeds->toArray())->except(['links']);

        return Response::api(__('message.Success'), 200, true, null, ['feeds' => $data]);
    }
}
