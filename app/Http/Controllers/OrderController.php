<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Tampilkan semua order
     */
    public function index()
    {
        $orders = Order::with('products')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Tampilkan form tambah order
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Simpan order baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $order = new Order();
        $order->customer_name = $request->customer_name;
        $order->save();

        $order->products()->attach($request->product_ids);

        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat.');
    }

    /**
     * Tampilkan detail order
     */
    public function show($id)
    {
        $order = Order::with('products')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Tampilkan form edit order
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update order
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $order = Order::findOrFail($id);
        $order->customer_name = $request->customer_name;
        $order->save();

        $order->products()->sync($request->product_ids);

        return redirect()->route('orders.index')->with('success', 'Order berhasil diupdate.');
    }

    /**
     * Hapus order
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->products()->detach();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }
}
