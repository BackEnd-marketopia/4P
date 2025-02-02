<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Discount;
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
        $vendor = Vendor::where('id', $id)->first();
        $discounts = $vendor->discounts()->where('start_date', '<=', now())->where('end_date', '>=', now())->get();
        return Response::api(__('message.Success'), 200, true, null, ['vendor' => $vendor, 'discounts' => $discounts]);
    }
}
