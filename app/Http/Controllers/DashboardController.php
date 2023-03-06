<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('id', 'DESC')->get();
        return view('dashboard.index', [
            'units' => $units,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'aktif' => 'required',
        ]);
        Unit::create($request->all());
        return redirect('/dashboard');
    }

    public function updateAktif(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
        return redirect('/dashboard');
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
        return redirect('/dashboard');
    }
}
