<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\BookingNotification;
use App\Notifications\NewBookingNotification;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $user = User::find(Auth::id());
        $validatedData = $request->validate([
            'date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'size' => 'required', // Добавлено правило для размера
        ]);

        $date = $validatedData['date'];
        $productId = $validatedData['product_id'];
        $size = $validatedData['size']; // Получение выбранного размера

        // Проверка наличия конфликтующих бронирований
        $conflictingBookings = Booking::where('product_id', $productId)
            ->where(function ($query) use ($date) {
                $query->where('date', '=', $date);
            })
            ->get();

        if ($conflictingBookings->isNotEmpty()) {
            // Если есть конфликтующие бронирования, возвращаем ошибку
            session()->flash('error_booking', 'Нельзя забронировать на эту дату');
            return redirect()->back();
        }

        // Создание нового бронирования
        $booking = new Booking();
        $booking->date = $date;
        $booking->product_id = $productId;
        $booking->user_id = Auth::user()->id;
        $booking->size = $size; // Сохранение выбранного размера
        if ($user->phone == null) {
            $booking->phone = $request->get('phone');
        }
        $booking->save();
        $notificationEmail = 'torgyn@bk.ru'; // Email address to receive the notification
        $user->notify(new BookingNotification($booking)); // Assuming you have a "OrderNotification" notification class

        // Отправляем уведомление администратору
        $adminEmail = config('app.admin_email'); // Предполагается, что email администратора находится в конфигурации приложения
        if ($adminEmail) {
            Notification::route('mail', $adminEmail)
                ->notify(new NewBookingNotification($booking));
        }

        session()->flash('booking_success', 'Товар успешно забронирован');
        return redirect()->back();
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();
        session()->flash('booking_delete', 'Бронирование успешно удалено');

        return redirect()->back();
    }
    public function occupied(Request $request)
    {
        $date = $request->input('date');

        $occupiedDates = Booking::where('date', $date)->exists();

        if ($occupiedDates) {
            return 'occupied';
        } else {
            return 'free';
        }
    }
}