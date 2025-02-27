<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountCheck;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(string $id)
    {
        $discount = Discount::findOrFail($id);

        $users = $discount->users()->withPivot('created_at')->paginate(10);

        return view('vendor.user-checked', compact('users'));
    }
}
