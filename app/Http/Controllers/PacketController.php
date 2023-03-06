<?php

namespace App\Http\Controllers;

use App\Models\Packet;
use App\Models\Unit;
use Illuminate\Http\Request;

class PacketController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        $packets = Packet::with('unit')->orderBy('id', 'DESC')->get();
        return view('dashboard.packets', [
            'packets' => $packets,
            'units' => $units
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'weight' => 'required',
            'satuan_id' => 'required',
            'price' => 'required',
            'branch' => 'required',
            'aktif' => 'required',
        ]);
        Packet::create($request->all());
        return redirect('/dashboard/packets');
    }

    public function update(Request $request, $id)
    {
        $packet = Packet::findOrFail($id);
        $packet->update($request->all());
        return redirect('/dashboard/packets');
    }

    public function updateAktif(Request $request, $id)
    {
        $packet = Packet::findOrFail($id);
        $packet->update($request->all());
        return redirect('/dashboard/packets');
    }
}
