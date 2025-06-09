<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(CartRequest $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();
            
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(CartRequest $request, Cart $cart)
    {
        $this->authorize('update', $cart);
        
        $cart->update([
            'quantity' => $request->quantity
        ]);
        
        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function destroy(Cart $cart)
    {
        $this->authorize('delete', $cart);
        
        $cart->delete();
        
        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}