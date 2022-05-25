<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CardDetails;
use App\Models\Order;
use App\Models\OrderItem;
class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(6)->withQueryString();
        return view('user.product.index',compact('products'));
    }

    public function addToCart($id){
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function cart(){
        return view('user.product.cart');
    }

    public function updateCart(Request $request){
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkout(){
        return view('user.product.checkout');
    }

    public function order(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'cc_name' => 'required',
            'cc_number' => 'required',
            'cc_expiration' => 'required',
            'cc_cvv' => 'required',
        ]);

        $cart = session()->get('cart');
      
        $card = CardDetails::create([
            'cc_name' => $request->cc_name,
            'cc_number' => $request->cc_number,
            'cc_expiration' => $request->cc_expiration,
            'cc_cvv' => $request->cc_cvv
        ]);

        $order = Order::create([
            'card_id' => $card->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' =>$request->email
        ]);

        foreach($cart as $k => $value){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $k,
                'queintity' => $value['quantity'],
            ]);
        }
        $request->session()->forget(['cart']);
        return redirect()->route('dashboard')->with('success', 'Order Placed successfully!');
    }
}
