<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index(Request $request) {
        $users = User::where('role','user')->when($request->search, fn($q,$s)=>$q->where('name','like',"%$s%")->orWhere('email','like',"%$s%"))->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
    public function show($id) {
        $user = User::with('orders')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $data = $request->validate(['name'=>'required','email'=>'required|email']);
        $user->update($data);
        return back()->with('success','User updated.');
    }
    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users.index')->with('success','User deleted.');
    }
    public function toggleBan($id) {
        $user = User::findOrFail($id);
        $user->update(['is_banned' => !$user->is_banned]);
        return back()->with('success', $user->is_banned ? 'User banned.' : 'User unbanned.');
    }
}
