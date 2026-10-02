<?php

namespace App\Http\Controllers;

use App\Models\PesertaMagang;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PesertaMagangController extends Controller
{
    /**
     * Menampilkan data peserta aktif.
     */
    public function index()
    {
        // Otomatis ubah peserta menjadi Selesai jika tanggal selesai sudah tercapai
        PesertaMagang::where('status', 'Aktif')
            ->whereDate('tanggal_selesai', '<=', Carbon::today())
            ->update([
                'status' => 'Selesai'
            ]);

        // Ambil hanya peserta yang masih aktif
        $pesertas = PesertaMagang::with('divisi')
            ->where('status', 'Aktif')
            ->latest()
            ->get();

        return view('peserta.index', compact('pesertas'));
    }


    /**
     * Menampilkan form tambah peserta.
     */
    public function create()
    {
        $divisis = Divisi::orderBy('nama_divisi')->get();

        return view('peserta.create', compact('divisis'));
    }


    /**
     * Menyimpan peserta baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'asal_instansi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'divisi_id' => 'required|exists:divisis,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',

            // Wajib saat tambah peserta
            'foto_surat_balasan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_surat_sekolah' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'foto_formal'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'foto_surat_balasan.required' => 'Foto surat balasan wajib diunggah.',
            'foto_surat_balasan.image'    => 'Surat balasan harus berupa gambar.',
            'foto_surat_balasan.mimes'    => 'Surat balasan hanya boleh berformat JPG, JPEG, atau PNG.',
            'foto_surat_balasan.max'      => 'Ukuran surat balasan maksimal 2 MB.',

            'foto_surat_sekolah.required' => 'Foto surat sekolah wajib diunggah.',
            'foto_surat_sekolah.image'    => 'Surat sekolah harus berupa gambar.',
            'foto_surat_sekolah.mimes'    => 'Foto surat sekolah hanya boleh berformat JPG, JPEG, atau PNG.',
            'foto_surat_sekolah.max'      => 'Ukuran foto surat sekolah maksimal 2 MB.',

            'foto_formal.required'        => 'Foto formal wajib diunggah.',
            'foto_formal.image'           => 'Foto formal harus berupa gambar.',
            'foto_formal.mimes'           => 'Foto formal hanya boleh berformat JPG, JPEG, atau PNG.',
            'foto_formal.max'             => 'Ukuran foto formal maksimal 2 MB.',
        ]);


        // Upload Berkas
        $fotoSuratBalasan = $request->file('foto_surat_balasan')->store('peserta/surat-balasan', 'public');
        $fotoSuratSekolah = $request->file('foto_surat_sekolah')->store('peserta/surat-sekolah', 'public');
        $fotoFormal       = $request->file('foto_formal')->store('peserta/foto-formal', 'public');


        // Simpan Data
        PesertaMagang::create([
            'nama'               => $request->nama,
            'asal_instansi'      => $request->asal_instansi,
            'jurusan'            => $request->jurusan,
            'no_hp'              => $request->no_hp,
            'email'              => $request->email,
            'divisi_id'          => $request->divisi_id,
            'tanggal_mulai'      => $request->tanggal_mulai,
            'tanggal_selesai'    => $request->tanggal_selesai,
            'status'             => 'Aktif',

            'foto_surat_balasan' => $fotoSuratBalasan,
            'foto_surat_sekolah' => $fotoSuratSekolah,
            'foto_formal'        => $fotoFormal,
        ]);

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan.');
    }


    /**
     * Menampilkan detail peserta.
     */
    public function show(PesertaMagang $peserta)
    {
        $peserta->load('divisi');

        return view('peserta.show', compact('peserta'));
    }


    /**
     * Menampilkan form edit peserta.
     */
    public function edit(PesertaMagang $peserta)
    {
        $divisis = Divisi::orderBy('nama_divisi')->get();

        return view('peserta.edit', compact('peserta', 'divisis'));
    }


    /**
     * Memperbarui data peserta.
     */
    public function update(Request $request, PesertaMagang $peserta)
    {
        // Validasi: tanggal_selesai dan foto-foto diatur NULLABLE (opsional saat edit)
        $request->validate([
            'nama'               => 'required|string|max:255',
            'asal_instansi'      => 'required|string|max:255',
            'jurusan'            => 'required|string|max:255',
            'no_hp'              => 'required|string|max:20',
            'email'              => 'nullable|email|max:255',
            'divisi_id'          => 'required|exists:divisis,id',
            'tanggal_mulai'      => 'required|date',
            'tanggal_selesai'    => 'nullable|date',

            'foto_surat_balasan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_surat_sekolah' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_formal'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        // Data dasar yang akan diupdate
        $data = [
            'nama'          => $request->nama,
            'asal_instansi' => $request->asal_instansi,
            'jurusan'       => $request->jurusan,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
            'divisi_id'     => $request->divisi_id,
            'tanggal_mulai' => $request->tanggal_mulai,
        ];


        // 1. TANGGAL SELESAI
        if ($request->filled('tanggal_selesai')) {
            $data['tanggal_selesai'] = $request->tanggal_selesai;

            // Update status berdasarkan tanggal selesai baru
            $data['status'] = Carbon::parse($request->tanggal_selesai)->lte(Carbon::today())
                ? 'Selesai'
                : 'Aktif';
        }


        // 2. SURAT BALASAN (Ganti jika ada upload baru)
        if ($request->hasFile('foto_surat_balasan')) {
            if ($peserta->foto_surat_balasan) {
                Storage::disk('public')->delete($peserta->foto_surat_balasan);
            }
            $data['foto_surat_balasan'] = $request->file('foto_surat_balasan')->store('peserta/surat-balasan', 'public');
        }


        // 3. FOTO SURAT SEKOLAH (Ganti jika ada upload baru)
        if ($request->hasFile('foto_surat_sekolah')) {
            if ($peserta->foto_surat_sekolah) {
                Storage::disk('public')->delete($peserta->foto_surat_sekolah);
            }
            $data['foto_surat_sekolah'] = $request->file('foto_surat_sekolah')->store('peserta/surat-sekolah', 'public');
        }


        // 4. FOTO FORMAL (Ganti jika ada upload baru)
        if ($request->hasFile('foto_formal')) {
            if ($peserta->foto_formal) {
                Storage::disk('public')->delete($peserta->foto_formal);
            }
            $data['foto_formal'] = $request->file('foto_formal')->store('peserta/foto-formal', 'public');
        }


        // Simpan perubahan ke database
        $peserta->update($data);


        return redirect()
            ->route('peserta.show', $peserta->id)
            ->with('success', 'Data peserta berhasil diperbarui.');
    }


    /**
     * Menghapus peserta.
     */
    public function destroy(PesertaMagang $peserta)
    {
        // Hapus file surat balasan
        if ($peserta->foto_surat_balasan) {
            Storage::disk('public')->delete($peserta->foto_surat_balasan);
        }

        // Hapus file foto surat sekolah
        if ($peserta->foto_surat_sekolah) {
            Storage::disk('public')->delete($peserta->foto_surat_sekolah);
        }

        // Hapus file foto formal
        if ($peserta->foto_formal) {
            Storage::disk('public')->delete($peserta->foto_formal);
        }

        // Hapus record dari database
        $peserta->delete();

        return redirect()
            ->route('peserta.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }
}