<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Add new item to database
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'item_name' => ['required'],
    ]);

    $existingItem = Item::where('name', ucfirst($request->input('item_name')))->first();

    if ($existingItem) {
        // Barang dengan nama yang sama sudah ada, maka kembalikan dengan pesan error
        return redirect()->route('admin.price-lists.index')
        ->with('error', 'Barang dengan nama tersebut sudah ada!');
    
    }

    // Barang belum ada, buat dan simpan item baru
    $item = new Item([
        'name' => ucfirst($request->input('item_name'))
    ]);
    $item->save();

    

}

}
