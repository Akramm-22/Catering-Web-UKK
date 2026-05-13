<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
        return view('user.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $package = Package::findOrFail($request->package_id);
        $cart    = session()->get('cart', []);
        $key     = 'pkg_' . $package->id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $request->qty ?? 1;
        } else {
            $cart[$key] = [
                'id'          => $package->id,
                'name'        => $package->name,
                'price'       => $package->price,
                'qty'         => $request->qty ?? 1,
                'image'       => $package->image,
                'min_pax'     => $package->min_pax,
                'menu_type'   => $package->menu_type,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Paket berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, (int) $request->qty);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}
