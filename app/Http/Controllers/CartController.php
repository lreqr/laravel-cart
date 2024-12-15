<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();

        $products = Product::with('translations')->paginate(8);

        $products->getCollection()->transform(function ($product) use ($locale) {
            $translation = $product->translation($locale);
            $product->name = $translation ? $translation->name : $product->name;
            $product->description = $translation ? $translation->description : $product->description;
            return $product;
        });

        return view('cart.index', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $locale = app()->getLocale();

        if (Auth::check()) {
            $validatedData = $request->validate([
                'product_id' => 'required|integer|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $validatedData['product_id'])
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $validatedData['quantity'];
                $cartItem->save();
                return response()->json(['success' => 'Quantity updated in cart!']);
            } else {
                $cart = new Cart([
                    'product_id' => $validatedData['product_id'],
                    'quantity' => $validatedData['quantity'],
                    'user_id' => Auth::id(),
                ]);
                $cart->save();

                return response()->json(['message' => __('messages.product_added_successfully')]);
            }
        } else {
            return response()->json(['error' => __('messages.you_must_be_logged_in')], 401);
        }
    }


    public function update(Request $request)
    {
        $cartItemId = $request->input('id');
        $quantity = (int)$request->input('quantity');

        if ($quantity <= 0) {
            return response()->json(['success' => false, 'message' => __('messages.invalid_quantity')], 422);
        }

        $cartItem = Cart::where('id', $cartItemId)
            ->where('user_id', Auth::id())
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();

            return response()->json(['success' => true, 'message' => __('messages.quantity_updated')]);
        }

        return response()->json(['success' => false, 'message' => __('messages.item_not_found')], 404);
    }

    public function destroy(Request $request)
    {
        $cartItemId = $request->input('id');

        $cartItem = Cart::where('id', $cartItemId)
            ->where('user_id', Auth::id())
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true, 'message' => __('messages.product_removed_successfully')]);
        }

        return response()->json(['success' => false, 'message' => __('messages.item_not_found')], 404);
    }

    public function getCartData()
    {
        if (Auth::check()) {
            $locale = App::getLocale();

            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();

            $cartItems->transform(function ($cartItem) use ($locale) {
                $product = $cartItem->product;
                $translation = $product->translation($locale);

                $product->name = $translation ? $translation->name : $product->name;
                $product->description = $translation ? $translation->description : $product->description;

                return $cartItem;
            });

            return response()->json($cartItems);

        }

        return response()->json(['error' => 'User not authenticated'], 403);
    }
}
