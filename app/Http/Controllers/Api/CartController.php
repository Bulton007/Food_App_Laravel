<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    // ADD TO CART
    public function store(Request $request)
    {
        $cart = Cart::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'message' => 'Added to cart',
            'data' => $cart
        ]);
    }

    // GET CART BY USER
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        return Cart::with('product.images', 'product.category')
            ->where('user_id', $user_id)
            ->get();
    }

    // UPDATE QUANTITY
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'message' => 'Cart updated',
            'data' => $cart
        ]);
    }

    // DELETE ITEM FROM CART
    public function destroy($id)
    {
        Cart::destroy($id);

        return response()->json([
            'message' => 'Item removed from cart'
        ]);
    }
    public function clearCart($user_id){
        Cart::where('user_id', $user_id)->delete();
        return response()->json([
            'message' => 'Cart cleared Successfully'
        ]);
    }
}