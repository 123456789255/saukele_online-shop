<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminIndex()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.admin');
        else
            return view('admin.none-admin');
    }

    public function orders(Request $request)
    {
        $status = $request->get('status');

        $orders = Order::query();

        if ($status) {
            $orders->where('status', $status);
        }

        $orders = $orders->orderBy('created_at', 'desc')->paginate(100000000);

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.orders', compact('orders', 'status'));
        else
            return view('admin.none-admin');
    }

    public function viewOrder($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.view_order', compact('order', 'user'));
        else
            return view('admin.none-admin');
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'Отменен';
        $order->save();

        foreach ($order->items as $item) {
            $product = $item->product;
            $product->quantity += $item->quantity;
            $product->save();
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == '2') {
            return redirect()->back()->with('success', 'Заказ отменен.');
        } else {
            return view('admin.none-admin');
        }
    }

    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'Подтвержден';
        $order->save();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect()->back()->with('success', 'Заказ подтвержден.');
        else
            return view('admin.none-admin');
    }

    public function products(Request $request)
    {
        $search = $request->get('search');

        $category = DB::table('categories')->get();

        $subcategories = DB::table('subcategories')->get();

        $products = Product::query();

        if ($search) {
            $products->where('name', 'like', '%' . $search . '%');
        }

        $products = $products->orderBy('created_at', 'desc')->paginate(10);

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.products', compact('products', 'search', 'category', 'subcategories'));
        else
            return view('admin.none-admin');
    }

    public function addProduct(Request $request)
    {
        $product = new Product;

        $fileFields = ['image', 'image_2', 'image_3', 'image_4', 'image_5'];
        $fileNames = [];

        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $fileName = time() . $file->getClientOriginalName();
                $file->move('img', $fileName);
                $fileNames[$fileField] = $fileName;
            }
        }

        $product->name = $request->input('name');
        $product->image = $fileNames['image'] ?? null;
        $product->image_2 = $fileNames['image_2'] ?? null;
        $product->image_3 = $fileNames['image_3'] ?? null;
        $product->image_4 = $fileNames['image_4'] ?? null;
        $product->image_5 = $fileNames['image_5'] ?? null;
        $product->price = $request->input('price');
        $product->gender = $request->input('gender');
        $product->category = $request->input('category');
        $product->subcategory = $request->input('subcategory');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->min_size = $request->input('min_size');
        $product->max_size = $request->input('max_size');
        $product->rent_or_buy = $request->input('rent_or_buy');
        $product->save();

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role == '2') {
            return redirect()->back()->with('success', 'Товар добавлен.');
        } else {
            return view('admin.none-admin');
        }
    }





    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $category = DB::table('categories')->get();
        $subcategories = DB::table('subcategories')->get();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.editProduct', compact('product', 'category', 'subcategories'));
        else
            return view('admin.none-admin');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->category = $request->input('category');
            $product->gender = $request->input('gender');
            $product->rent_or_buy = $request->input('rent_or_buy');
            $product->quantity = $request->input('quantity');
            $product->min_size = $request->input('min_size');
            $product->max_size = $request->input('max_size');

            // Обновление изображений, если они предоставлены
            for ($i = 1; $i <= 5; $i++) {
                if ($request->hasFile("image_$i")) {
                    $file = $request->file("image_$i");
                    $filename = time() . $file->getClientOriginalName();
                    $file->move('img', $filename);

                    $product->{"image_$i"} = $filename;
                }
            }

            $product->save();

            return redirect()->route('admin.products');
        } else {
            return redirect()->back()->with('error', 'Товар не найден.');
        }
    }





    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect()->back()->with('success', 'Товар удален.');
        else
            return view('admin.none-admin');
    }

    public function categories()
    {
        $categories = Category::all();
        $subcategories = Subcategory::with('category')->get();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.categories', compact('categories', 'subcategories'));
        else
            return view('admin.none-admin');
    }

    public function addCategory(Request $request)
    {
        $category = new Category;

        $category->name_category = $request->get('name');
        $category->save();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect()->back()->with('success', 'Категория добавлена.');
        else
            return view('admin.none-admin');
    }

    public function addSubcategory(Request $request)
    {
        $subcategory = new Subcategory;

        $categoryID = $request->input('sub_cat'); // Получаем идентификатор категории
        $subcategoryName = $request->input('subcategory_name' . $categoryID); // Получаем значение поля с уникальным именем

        $subcategory->name = $subcategoryName;
        $subcategory->category_id = $categoryID;
        $subcategory->save();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect()->back()->with('success', 'Категория добавлена.');
        else
            return view('admin.none-admin');
    }

    public function deleteCategory($id)
    {
        $category  = Category::find($id);
        $category->delete();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect()->back()->with('success', 'Категория  удален.');
        else
            return view('admin.none-admin');
    }

    public function deleteSubcategory($id)
    {
        $subcategory  = Subcategory::find($id);
        $subcategory->delete();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect()->back()->with('success', 'Категория  удален.');
        else
            return view('admin.none-admin');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.edit-category', compact('category'));
        else
            return view('admin.none-admin');
    }

    // метод обновления категории в базе данных
    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category) {
            $categoryName = $request->input('category_name' . $category->id);

            $category->name_category = $categoryName;
            $category->save();
            return redirect()->route('admin.category');
        } else {
            return redirect()->back()->with('error', 'Категория не найдена.');
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.edit-category', compact('category'));
        else
            return view('admin.none-admin');
    }

    public function updateSubcategory(Request $request, $id)
    {
        $subcategory = Subcategory::find($id);

        if ($subcategory) {
            $subcategoryName = $request->input('edit_subcategory_name' . $subcategory->id); // Получаем значение поля с уникальным именем

            $subcategory->name = $subcategoryName;
            $subcategory->save();

            return redirect()->route('admin.category');
        } else {
            return redirect()->back()->with('error', 'Подкатегория не найдена.');
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2') {
            return view('admin.edit-category', compact('category'));
        } else {
            return view('admin.none-admin');
        }
    }

    public function users()
    {
        $users = User::all();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return view('admin.users', compact('users'));
        else
            return view('admin.none-admin');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->role = $request->get('role');
        $user->save();

        return redirect()->route('admin.users');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect('/admin/users')->with('success');
        else
            return view('admin.none-admin');
    }

    public function showBooking(Request $request)
    {
        $status = $request->get('status');
        $user = Auth::user();

        $bookings = Booking::query();

        if ($status) {
            $bookings->where('status', $status);
        }

        $bookings = $bookings->orderBy('created_at', 'desc')->paginate(100000000);

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            // return redirect('/admin');
            return view('admin.booking', compact('bookings', 'status', 'user'));
        else
            return view('admin.none-admin');
    }

    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = 'Отменен';
        $booking->save();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect()->back()->with('success', 'Бронирование отменено.');
        else
            return view('admin.none-admin');
    }

    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->status = 'Подтвержден';
        $booking->save();

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role == '2')
            return redirect()->back()->with('success', 'Бронирование подтверждено.');
        else
            return view('admin.none-admin');
    }
}
