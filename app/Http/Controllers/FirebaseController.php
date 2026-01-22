<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase->getDatabase();
    }

    public function index()
    {
        $factory = (new Factory)
            ->withServiceAccount('C:/laragon/www/uascloud/storage/app/firebase/firebase_credentials.json')
            ->withDatabaseUri(config('firebase.database.url'));

        $database = $factory->createDatabase();
        $data = $database->getReference('inventori_lab')->getValue();

        $quote = null;
        try {
            $response = Http::get('https://quotes.liupurnomo.com/api/quotes/random');
            if ($response->successful()) {
                $quote = $response->json()['data'];
            }
        } catch (\Exception $e) {
            $quote = null;
        }

        return view('dashboard', compact('data', 'quote'));
    }


    public function test()
    {
        $this->firebase->getReference("testing")
            ->set([
                'message' => 'Firebase Integration Successful!'
            ]);

        return 'Firebase Connected and Test Data Added!';
    }

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

        $factory = (new Factory)
            ->withServiceAccount('C:/laragon/www/uascloud/storage/app/firebase/firebase_credentials.json')
            ->withDatabaseUri(config('firebase.database.url'));

        $database = $factory->createDatabase();

        $database->getReference('inventori_lab')->push([
            'nama_alat' => $request->nama,
            'kode_alat' => $request->kode,
            'stok' => $request->stok,
            'lokasi' => $request->lokasi,
            'kondisi' => $request->kondisi,
            'petugas' => $request->petugas,
            'user_id' => session('firebase_uid'),
            'tanggal_input' => now()->toDateString(),
        ]);
        return redirect('dashboard')->with('success', 'Data berhasil disimpan');
    }
}
