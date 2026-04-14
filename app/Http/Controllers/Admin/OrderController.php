<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function index(Request $request) {
        $orders = Order::with('user')->when($request->status, fn($q,$s)=>$q->where('status',$s))->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id) {
        $order = Order::with(['user','items.shopItem'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, $id) {
        $request->validate(['status'=>'required|in:pending,paid,processing,completed,cancelled,refunded']);
        Order::findOrFail($id)->update(['status'=>$request->status]);
        return back()->with('success','Order status updated.');
    }
}
