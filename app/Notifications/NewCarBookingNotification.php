<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCarBookingNotification extends Notification
{
    use Queueable;

    public $booking;
    public $car;

    // Kita terima data Booking dan Data Mobil
    public function __construct($booking, $car)
    {
        $this->booking = $booking;
        $this->car = $car;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $rentalType = $this->booking->rental_type ? 'With Driver (Dengan Supir)' : 'Self Drive (Lepas Kunci)';
        $start = \Carbon\Carbon::parse($this->booking->start_date)->format('d M Y');
        $end = \Carbon\Carbon::parse($this->booking->end_date)->format('d M Y');

        return (new MailMessage)
                    ->subject("🚗 Booking Sewa Mobil: " . $this->booking->customer_name)
                    ->greeting('Halo Admin GOING TO THE JAVA!')
                    ->line('Ada pesanan sewa mobil baru masuk.')
                    ->line('---------------------------------')
                    ->line('👤 **Nama:** ' . $this->booking->customer_name)
                    ->line('📞 **Telepon:** ' . $this->booking->customer_phone)
                    ->line('🚘 **Mobil:** ' . $this->car->name_car)
                    ->line('---------------------------------')
                    ->line('🔑 **Tipe Sewa:** ' . $rentalType)
                    ->line('📅 **Tanggal:** ' . $start . ' s/d ' . $end)
                    ->line('dh **Durasi:** ' . $this->booking->duration_days . ' Hari')
                    ->line('💰 **Total:** Rp ' . number_format($this->booking->total_price, 0, ',', '.'))
                    ->action('Buka Dashboard Admin', url('/admin/car-bookings')) // Sesuaikan route admin Anda
                    ->line('Mohon segera dicek ketersediaan unitnya. Terima kasih!');
    }
}