<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $items = [];
        $subtotal = 0;

        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if (!$product) continue;
            $item = (object) [
                'product' => $product,
                'quantity' => $qty,
                'total' => $product->price * $qty,
            ];
            $items[] = $item;
            $subtotal += $item->total;
        }

        $shipping = $subtotal > 0 ? ($subtotal >= 200 ? 0 : 19.90) : 0;
        $total = $subtotal + $shipping;

        return view('checkout.cart', compact('items', 'subtotal', 'shipping', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);

        $product = Product::where('id', $request->product_id)->where('is_active', true)->firstOrFail();
        $qty = max(1, (int) $request->quantity ?: 1);

        $cart = Session::get('cart', []);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $qty;
        Session::put('cart', $cart);

        return response()->json([
            'count' => array_sum($cart),
            'message' => 'Produit ajouté au panier.',
        ]);
    }

    public function update(Request $request, $id)
    {
        $qty = max(1, (int) $request->quantity);
        $cart = Session::get('cart', []);
        $cart[$id] = $qty;
        Session::put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);

        return redirect()->route('cart.index');
    }

    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index');
    }
}