<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use App\Models\Tindakan;


class AdminController extends Controller
{

    //obat
    public function indexobat()
    {
        $obats = Obat::paginate(10);
        return view('admin.pages.admin.obat.index', compact('obats'));
    }

    public function storeobat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        Obat::create($request->only(['nama_obat', 'harga']));

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function updateobat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->only(['nama_obat', 'harga']));

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil diupdate.');
    }

    public function destroyobat($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil dihapus.');
    }


    //TINDAKAN
    public function indextindakan()
    {
        $tindakans = Tindakan::paginate(10);
        return view('admin.pages.admin.tindakan.index',compact('tindakans'));
    }

        public function storetindakan(Request $request)
    {
        $request->validate([
            'nama_tindakan' => 'required|string|max:255',
            'tarif' => 'required|numeric',
        ]);

        Tindakan::create($request->only(['nama_tindakan', 'tarif']));

        return redirect()->route('admin.tindakan.index')->with('success', 'Tindakan berhasil ditambahkan.');
    }

        public function updatetindakan(Request $request, $id)
    {
        $request->validate([
            'nama_tindakan' => 'required|string|max:255',
            'tarif' => 'required|numeric',
        ]);

        $tindakan = Tindakan::findOrFail($id);
        $tindakan->update($request->only(['nama_tindakan', 'tarif']));

        return redirect()->route('admin.tindakan.index')->with('success', 'Tindakan berhasil diupdate.');
    }
    
    public function destroytindakan($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        $tindakan->delete();

        return redirect()->route('admin.tindakan.index')->with('success', 'Tindakan berhasil dihapus.');
    }

    //daftar USER
    public function indexuser()
    {
        $users = user::paginate(10);
        return view('admin.pages.admin.user.index',compact('users'));
    }

    public function storeuser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'jabatan' => 'required|string|max:255',
        ]);

        // Tentukan roles_id berdasarkan jabatan
        $jabatan = strtolower($request->jabatan);
        $roles_id = match (strtolower($request->jabatan)) {
            'admin' => 1,
            'kasir' => 2,
            'dokter' => 3,
            'pendaftaran' => 4,
            'staff' => 5,
            'perawat' => 6,
            default => null,
        };


        // Buat User
        $user = User::create([
            'roles_id' => $roles_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Buat Pegawai
        Pegawai::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }


    public function updateuser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6',
            'jabatan' => 'required|string|in:Admin,Dokter,Kasir,Pendaftaran,Staff,Perawat',
        ]);

        // Cari user dulu
        $user = User::findOrFail($id);

        // Cari pegawai berdasarkan user_id
        $pegawai = Pegawai::where('user_id', $user->id)->firstOrFail();

        // Tentukan roles_id berdasarkan jabatan
        $jabatan = strtolower($request->jabatan);
        $roles_id = match ($jabatan) {
            'dokter' => 3,
            'admin' => 1,
            'kasir' => 2,
            'pendaftaran' => 4,
            'staff' => 5,
            'perawat' => 6,
            default => 0,
        };

        // Update user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles_id = $roles_id;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update pegawai
        $pegawai->update([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroyuser($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus data pegawai yang memiliki user_id ini
        Pegawai::where('user_id', $user->id)->delete();

        // Hapus user
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User dan data pegawai berhasil dihapus.');
    }

    //Pegawai
    public function indexpegawai()
    {
        $pegawais = pegawai::paginate(10);
        return view('admin.pages.admin.pegawai.index',compact('pegawais'));
    }


}
