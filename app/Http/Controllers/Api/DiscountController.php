<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckDiscountRequest;
use App\Models\Discount;
use App\Models\DiscountCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DiscountController extends Controller
{
    public function index($id)
    {
        $user = auth('api')->user();
        $discounts = Discount::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->findOrFail($id);

        $discounts->viwe_count += 1;
        $discounts->save();

        if ($user) {
            $discount_check = DiscountCheck::where('user_id', auth('api')->user()->id)
                ->where('discount_id', $id)
                ->first();
            $discounts->is_checked = $discount_check ? true : false;
        } else
            $discounts->is_checked = false;

        return Response::api(__('message.Success'), 200, true, null, ['discounts' => $discounts]);
    }

    public function discountChecked($discountId)
    {
        Discount::findOrFail($discountId);

        $user = auth('api')->user();
        if (!$user)
            return Response::api(__('message.Login First'), 403, false, 403);

        if (!$user->code)
            return Response::api(__('message.You Are Not subscribed'), 403, false, 403);

        $discount_check = DiscountCheck::where('user_id', auth('api')->user()->id)
            ->where('discount_id', $discountId)
            ->first();

        if ($discount_check)
            return Response::api(__('message.Already Checked'), 403, false, 403);

        DiscountCheck::create([
            'user_id' => auth('api')->user()->id,
            'discount_id' => $discountId,
        ]);
        return Response::api(__('message.Success'), 200, true, null);
    }
}
