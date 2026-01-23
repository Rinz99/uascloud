<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FirebaseController extends Controller
{
    protected $database;

    public function __construct(FirebaseService $firebase)
    {
        $this->database = $firebase->getDatabase();
    }

    // DASHBOARD
    public function index()
    {
        // AMAN: cegah null
        $data = $this->database
            ->getReference('inventori_lab')
            ->getValue() ?? [];

        // Quote API (aman)
        $quote = null;
        try {
            $response = Http::timeout(3)
                ->get('https://quotes.liupurnomo.com/api/quotes/random');

            if ($response->successful()) {
                $quote = $response->json()['data'] ?? null;
            }
        } catch (\Exception $e) {
            $quote = null;
        }

        return view('dashboard', compact('data', 'quote'));
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'stok' => 'required|numeric',
            'lokasi' => 'required',
            'kondisi' => 'required',
            'petugas' => 'required',
        ]);

        $this->database
            ->getReference('inventori_lab')
            ->push([
                'nama_alat' => $request->nama,
                'kode_alat' => $request->kode,
                'stok' => $request->stok,
                'lokasi' => $request->lokasi,
                'kondisi' => $request->kondisi,
                'petugas' => $request->petugas,
                'user_id' => session('firebase_uid'),
                'tanggal_input' => now()->toDateString(),
            ]);

        return redirect('/dashboard')->with('success', 'Data berhasil disimpan');
    }

    // TEST FIREBASE
    public function test()
    {
        $this->database->getReference("testing")->set([
            'message' => 'Firebase Integration Successful!'
        ]);

        return 'Firebase Connected!';
    }

    // LOGIN FIREBASE
    public function firebaseLogin(Request $request, Auth $auth)
    {
        $verifiedIdToken = $auth->verifyIdToken($request->token);
        $uid = $verifiedIdToken->claims()->get('sub');

        session(['firebase_uid' => $uid]);

        return response()->json([
            'status' => 'success',
            'uid' => $uid
        ]);
    }
}
