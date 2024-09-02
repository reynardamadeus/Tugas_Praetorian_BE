<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProductToCart($id)   
    {
        $product = Product::findOrFail($id);
        if($product->stock == 0)
        {
            return redirect()->back()->with('error', 'The item you select has run out, please wait for a restock');
        }
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id]))
        {
            if($product->stock == $cart[$id]['quantity'])
            {
                return redirect()->back()->with('error', 'you cannot add more');
            }
            $cart[$id]['quantity']++;
            $cart[$id]['sub_total'] = $cart[$id]['quantity'] * $cart[$id]['price'];

        }else
        {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "photo" => $product->photo,
                "category" => $product->category->name,
                "sub_total" => $product->price
            ];
        }
        session()->put('cart', $cart);

        Cart::updateOrCreate(
            ['user_id' => Auth::user()->id ],
            ['cart_items' => $cart]     
        );

        return redirect()->back()->with('success', $cart[$id]['quantity'] . 'x ' . $product->name . ' has been added to cart!' );
        
    }

    public function deleteProductInCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart',$cart);
        
        $cart_database = Cart::where('user_id', Auth::user()->id)->first();
        $cart_database->update(
            ['cart_items' => $cart]     
        );

        return redirect()->back()->with('success',  'Item has been removed from cart!' );
    }

    public function plusOrMinusItemQty($id, $PoM)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart');

        if (isset($cart[$id])) 
        {
            if($PoM == 0)
            {
                $cart[$id]['quantity']--;
                if($cart[$id]['quantity'] == 0)
                {
                    unset($cart[$id]);
                }
            }else if($PoM == 1)
            {
                if($cart[$id]['quantity'] == $product->stock)
                {
                    return  redirect()->back()->with('error',  'Item has reached the max quantity you can order!' );
                }
                $cart[$id]['quantity']++;
            }else{
                return redirect()->back()->with('error',  'Error!' );
            }

            session()->put('cart', $cart);

            $cart_database = Cart::where('user_id', Auth::user()->id)->first();
            $cart_database->update(
                ['cart_items' => $cart]     
            );

            return redirect()->back();
        }else
        {
            return redirect()->back()->with('error',  'Error!' );
        }
        
    }

    public function getCart()
    {
        $cart_products = collect(session()->get('cart'));

        $cart_total = 0;
        if(session('cart')){
            foreach ($cart_products as $key => $product) {
                $cart_total += $product['quantity'] * $product['price'];
            }
        }
        return view('user.cart', compact('cart_total'));
    }

    public function submitCart(Request $request)
    {
        $cart = session()->get('cart');

        $request->validate([
            'address' => ['required', 'min:10', 'max:100', 'string'],
            'pos_code' => ['required', 'digits:5', 'string']
        ]);

        $invoice = now()->format('Y/m/d').'/'.Str::random(4);

        Order::create([
            'user_id' => Auth::user()->id,
            'invoice' => $invoice,
            'items' => $cart,
            'address' => $request->address,
            'pos_code' => $request->pos_code,
            'total' => $request->total
        ]);

        foreach ($cart as $id => $item) {
            $product = Product::findOrFail($id);
            $stock_left =  $product->stock - $item['quantity'];
            if($stock_left < 0)
            {
                return redirect()->back()->with('error', 'One of the items you ordered has run out, please wait for  a restock');
            }
            $product->update([
                'stock' => $stock_left
            ]);
        }

        session()->forget('cart');
        
        Auth::user()->cart->update(
                ['cart_items' => NULL]    
        );
        

        return redirect()->route('user.dashboard')->with('success', 'Orders submitted!');
    }

    public function getOrderPage()
    {
        $orders = Auth::user()->orders()->get();
        return view('user.order', compact('orders'));
    }
}
