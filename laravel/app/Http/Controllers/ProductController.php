<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;

class ProductController extends Controller
{
    public function show(product $product)
    {
        $user = User::find(Auth::id());
        $products = Product::orderBy('created_at', 'desc')->limit(4)->get();
        $occupiedDates = Booking::pluck('date')->toArray();
        return view('product', compact('product', 'products', 'user', 'occupiedDates'));
    }

    public function about()
    {
        $products = Product::orderBy('created_at', 'desc')->limit(4)->get();
        return view('welcome', compact('products'));
    }

    public function index(){
        return redirect()->route('about');
    }
}