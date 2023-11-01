<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Booking;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = Product::orderBy('created_at', 'desc')->limit(4)->get();
        $bookings = Booking::where('user_id', $user->id)->get();
        $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        return view('orders.index', ['orders' => $orders, 'bookings' => $bookings, 'products' => $products]);
    }

    public function show(Order $order)
    {
        $user = Auth::user();
        $products = Product::orderBy('created_at', 'desc')->limit(4)->get();
        if ($user->id !== $order->user_id) {
            abort(403);
        }

        return view('orders.show', compact('order', 'user', 'products'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('order_delete', 'Заказ успешно удален');

        return redirect()->route('orders.index');
    }
}