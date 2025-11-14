<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:191',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $to = config('mail.from.address', 'satgas@polsub.ac.id');

        // Kirim email sederhana (fallback ke mail.from jika terkonfigurasi)
        Mail::raw(
            "Nama: {$data['name']}\nEmail: {$data['email']}\n\nPesan:\n{$data['message']}",
            function ($message) use ($data, $to) {
                $message->to($to)
                        ->subject('[Kontak Website] ' . $data['subject'])
                        ->replyTo($data['email'], $data['name']);
            }
        );

        return redirect()->back()->with('success', 'Pesan terkirim. Terima kasih.');
    }
}
