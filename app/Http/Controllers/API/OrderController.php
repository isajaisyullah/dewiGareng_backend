<?php

namespace App\Http\Controllers\API;

use App\Models\Umkm;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function whatsAppMessage(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:product,id',
            'umkm_id' => 'required|exists:umkm,id',
            'banyaknya' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        $product = Product::find($validated['id']);
        $productName = $product->name;
        $price = $product->price;
        $banyak = $validated['banyaknya'];
        $totalHarga = $price * $banyak;

        $keterangan = $validated['keterangan'] ?? "-";

        $user = Umkm::join('users', 'umkm.users_id', '=', 'users.id')
        ->where('umkm.id', '=', $validated['umkm_id'])
        ->select('umkm.name as name', 'users.phone')
        ->first();

        $umkm = $user->name;
        $phone = substr($user->phone, 1);

        // Compose the WhatsApp message
        $message = "Halo Admin " . $umkm . ", Saya ingin membeli produk ini: \n\n*Nama Produk* : " . $productName .
                    "\n*sebanyak* : " . $banyak . "\n*total harga* : " . $totalHarga . "\n*keterangan* : " . $keterangan .
                    "\n\nTolong diproses ya, Terimakasih!";

        // Create a link to the WhatsApp API
        $whatsAppSend = "https://api.whatsapp.com/send/?phone=62" . $phone . "&text=" . urlencode($message);

        // Redirect the user to the WhatsApp link
        return redirect($whatsAppSend);

        // if ($response->successful()) {
        //     // Redirect the user to the WhatsApp link
        //     return redirect($whatsAppSemd . '?' . http_build_query($data));
        // } else {
        //     // Handle the error, for example, log it or return an error response
        //     return response()->json(['error' => 'Failed to send WhatsApp message'], 500);
        // }
    }
}
