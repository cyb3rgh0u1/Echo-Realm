<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    public function index() {
        $cart = session('cart', []);
        $items = [];
        $total = 0;
        foreach ($cart as $id => $qty) {
            $item = ShopItem::find($id);
            if ($item) { $items[] = ['item'=>$item,'qty'=>$qty]; $total += $item->price * $qty; }
        }
        return view('client.shop.cart', compact('items','total'));
    }
    public function add(Request $request) {
        $request->validate(['item_id'=>'required|exists:shop_items,id','qty'=>'integer|min:1']);
        $cart = session('cart', []);
        $id = $request->item_id;
        $cart[$id] = ($cart[$id] ?? 0) + ($request->qty ?? 1);
        session(['cart'=>$cart]);
        return back()->with('success','Added to cart!');
    }
    public function remove(Request $request) {
        $cart = session('cart', []);
        unset($cart[$request->item_id]);
        session(['cart'=>$cart]);
        return back()->with('success','Removed from cart.');
    }
    public function update(Request $request) {
        $cart = session('cart', []);
        if ($request->qty < 1) unset($cart[$request->item_id]);
        else $cart[$request->item_id] = $request->qty;
        session(['cart'=>$cart]);
        return back()->with('success','Cart updated.');
    }
    public function checkout() {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('shop.index')->with('error','Your cart is empty.');
        $items = []; $total = 0;
        foreach ($cart as $id => $qty) {
            $item = ShopItem::find($id);
            if ($item) { $items[] = ['item'=>$item,'qty'=>$qty]; $total += $item->price * $qty; }
        }
        return view('client.shop.checkout', compact('items','total'));
    }
    public function process(Request $request) {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('shop.index');
        $total = 0;
        $orderItems = [];
        foreach ($cart as $id => $qty) {
            $item = ShopItem::find($id);
            if ($item) { $total += $item->price * $qty; $orderItems[] = ['item'=>$item,'qty'=>$qty]; }
        }
        $order = Order::create([
            'order_number' => Order::generateNumber(),
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'paid',
            'payment_method' => 'demo',
            'billing_info' => $request->only(['name','email']),
        ]);
        foreach ($orderItems as $oi) {
            OrderItem::create(['order_id'=>$order->id,'shop_item_id'=>$oi['item']->id,'quantity'=>$oi['qty'],'price'=>$oi['item']->price]);
        }
        session()->forget('cart');
        return redirect()->route('orders.show', $order->id)->with('success','Order placed successfully!');
    }
    public function orders() {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('client.shop.orders', compact('orders'));
    }
    public function orderShow($id) {
        $order = Order::with(['items.shopItem'])->where('user_id',Auth::id())->findOrFail($id);
        return view('client.shop.order-show', compact('order'));
    }
}
