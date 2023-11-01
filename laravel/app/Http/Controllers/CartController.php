<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderNotification;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;


class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        $quantity = $request->input('quantity', 1);
        $cartQuantity = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->sum('quantity');

        if (($cartQuantity + $quantity) > $product->quantity) {
            session()->flash('error_catalog', 'Вы достигли лимита добавления товара в корзину');
            return redirect()->back();
        }

        $size = $request->input('size'); // Получаем выбранный размер

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('size', $size) // Проверяем, есть ли уже такой товар с выбранным размером в корзине
            ->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            $cart = new Cart([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'size' => $size, // Добавляем выбранный размер в модель корзины
            ]);
            $cart->save();
        }

        return redirect()->back()->with(session()->flash('cart_success', 'Товар успешно добавлен в корзину'));
    }




    public function addOnCart(Request $request, $productId)
    {
        // Проверяем, что пользователь авторизован
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::find($productId);
        $cart = Cart::where(['user_id' => auth()->id(), 'product_id' => $productId])->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $request->input('quantity', 1);
            if ($newQuantity > $product->quantity) {
                // Если товара недостаточно на складе, добавляем флэш-сообщение с ошибкой
                session()->flash('error', 'Вы достигли лимита добавления товара в корзину');
                return redirect()->back();
            }
            $cart->quantity = $newQuantity;
        } else {
            if ($request->input('quantity', 1) > $product->quantity) {
                // Если товара недостаточно на складе, добавляем флэш-сообщение с ошибкой
                session()->flash('error', 'Вы достигли лимита добавления товара в корзину');
                return redirect()->back();
            }
            $cart = new Cart();
            $cart->user_id = auth()->id();
            $cart->product_id = $productId;
            $cart->quantity = $request->input('quantity', 1);
        }

        $cart->save();
        // if ($request->input('quantity', 1)) {
        //     session()->flash('cart_success', 'Товар успешно добавлен в корзину');
        // }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::id());
        $carts = Cart::where('user_id', Auth::id())->get();

        if ($user->phone == null) {
            $this->validate($request, [
                'phone' => 'required|integer',
            ]);
        }

        if (!$carts) {
            return response()->json(['cart' => 'Empty']);
        }

        $invalidProducts = [];

        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->quantity) {
                $invalidProducts[] = $cart->product->name;
            } else {
                $cart->product->quantity -= $cart->quantity;
                $cart->product->save();
            }
        }

        if (!empty($invalidProducts)) {
            $error_message = 'Товары "' . implode('", "', $invalidProducts) . '" недоступны в таком количестве';
            session()->flash('error_cart', $error_message);
            return redirect()->back();
        }

        $order = new Order();
        if ($user->phone == null) {
            $order->user_phone = $request->get('phone');
        }
        $order->user_id = Auth::id();
        $order->save();

        // Send email notification
        $notificationEmail = 'torgyn@bk.ru'; // Email address to receive the notification
        $user->notify(new OrderNotification($order)); // Assuming you have a "OrderNotification" notification class

        // Отправляем уведомление администратору
        $adminEmail = config('app.admin_email'); // Предполагается, что email администратора находится в конфигурации приложения
        if ($adminEmail) {
            Notification::route('mail', $adminEmail)
                ->notify(new NewOrderNotification($order));
        }

        foreach ($carts as $cart) {
            $order->items()->create([
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
                'size' => $cart->size,
            ]);
            $cart->delete();
        }

        return redirect()->route('orders.show', ['order' => $order])->with('success', 'Заказ успешно оформлен');
    }


    public function removeFromCart(Request $request, $productId)
    {
        // Проверяем, что пользователь авторизован
        if (!Auth::check()) {
            return response()->json(['error' => 'Необходимо авторизоваться']);
        }

        $cart = Cart::where('product_id', $productId)->first();
        $cart->quantity--;
        if ($cart->quantity < 1) {
            $cart->delete();
        } else {
            $cart->save();
        }

        return redirect()->back();
    }

    public function removeAllFromCart($cartId)
    {
        $cart = Cart::find($cartId);

        if (!$cartId) {
            abort(404);
        }

        if ($cart) {
            $cart->delete();
        }

        return redirect()->route('cart.show');
    }




    public function showCart()
    {

        // Проверяем, что пользователь авторизован
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = User::find(Auth::id());
        $products = Product::orderBy('created_at', 'desc')->limit(4)->get();
        $count = Cart::count(); // получаем количество предметов в корзине с помощью соответствующего пакета, например, cartalyst/cart
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();

        return view('cart', compact('carts', 'count', 'products', 'user'));
    }
}
