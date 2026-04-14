<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabunganModel;

use function Laravel\Prompts\alert;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historyTabungan7Hari = TabunganModel::where('tanggal', '>=', now()->subDays(7))
                            ->latest()
                            ->get();
        $totalTabung = TabunganModel::where('tipe', 'tabung')->sum('nominal');
        $totalTarik = TabunganModel::where('tipe', 'tarik')->sum('nominal');
        $totalTabungan = $totalTabung - $totalTarik;
        return view('beranda', compact('historyTabungan7Hari', 'totalTarik', 'totalTabung', 'totalTabungan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $totalTabung = TabunganModel::where('tipe', 'tabung')->sum('nominal');
        $totalTarik = TabunganModel::where('tipe', 'tarik')->sum('nominal');
        $totalTabungan = $totalTabung - $totalTarik;
        return view('Tabung', compact('totalTabungan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'tanggal' => 'required|date',
        'nominal' => 'required|numeric|min:500',
    ]);

    TabunganModel::create([
        'tanggal' => $request->tanggal,
        'nominal' => $request->nominal,
        'tipe'    => 'Tabung',
    ]);

        return redirect()->back()->with('succsess', 'Uang Telah Tersimpan');
    }

    public function viewTarik(){
        $totalTabung = TabunganModel::where('tipe', 'tabung')->sum('nominal');
        $totalTarik = TabunganModel::where('tipe', 'tarik')->sum('nominal');
        $totalTabungan = $totalTabung - $totalTarik;
        return view('Tarik', compact('totalTabungan'));
    }

    /* Logic Tarik Uang*/

    public function tarik(Request $request)
    {
       $request->validate([
            'tanggal'=> 'required|date',
            'nominal'=> 'required|numeric|min:500',
        ]);

        $totalTabung = TabunganModel::where('tipe', 'Tabung')->sum('nominal');
        $totalTarik = TabunganModel::where('tipe', 'Tarik')->sum('nominal');
        $totalTabungan = $totalTabung - $totalTarik;

        if($request->nominal > $totalTabungan){
            return redirect()->back()->with('error', 'Uang Yang Ada Tidak Mencukupi')->withInput();
        } else{
            TabunganModel::create([
                'tanggal'=> $request->tanggal,
                'nominal'=> $request->nominal,
                'tipe' => 'Tarik'
            ]);
        return redirect()->route('Tabungan.index');
        }
    }

    public function viewRiwayat()
    {
        $historyTabungan = TabunganModel::all();
        $totalTabung = TabunganModel::where('tipe', 'Tabung')->sum('nominal');
        $totalTarik = TabunganModel::where('tipe', 'Tarik')->sum('nominal');
        $totalTabungan = $totalTabung - $totalTarik;
        return view('DataRiwayat', compact('historyTabungan', 'totalTabungan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = TabunganModel::findOrFail($id);
        $data->delete();    
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}
