<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBookingNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        // Tentukan detail berdasarkan tipe paket
        $tipe = ucfirst($this->booking->package_type);
        $paket = $this->booking->package_type === 'regular' 
            ? $this->booking->destination_name 
            : $this->booking->custom_destinations;

        return (new MailMessage)
                    ->subject("🔔 Booking Baru ($tipe): " . $this->booking->first_name)
                    ->greeting('Halo Admin GOING TO THE JAVA!')
                    ->line('Ada pesanan baru masuk melalui website.')
                    ->line('---------------------------------')
                    ->line('👤 **Nama:** ' . $this->booking->first_name . ' ' . $this->booking->last_name)
                    ->line('📞 **Telepon:** ' . $this->booking->phone_number)
                    ->line('📧 **Email:** ' . $this->booking->email)
                    ->line('🌍 **Negara:** ' . $this->booking->country)
                    ->line('---------------------------------')
                    ->line('📦 **Tipe:** ' . $tipe)
                    ->line('📍 **Tujuan:** ' . $paket)
                    ->line('📅 **Tanggal:** ' . $this->booking->travel_date)
                    ->line('👥 **Jumlah:** ' . $this->booking->travelers . ' Orang')
                    ->action('Buka Dashboard Admin', url('/admin/dashboard')) // Ganti URL sesuai route admin Anda
                    ->line('Mohon segera ditindaklanjuti. Terima kasih!');
    }
}