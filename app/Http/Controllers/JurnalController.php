<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    /**
     * Menampilkan daftar jurnal peserta
     */
    public function index()
    {
        $pesertas = PesertaMagang::with('divisi', 'jurnal')
            ->where('status', 'Aktif')
            ->orderBy('nama')
            ->get();

        return view('jurnal.index', compact('pesertas'));
    }

    /**
     * Menampilkan form upload jurnal
     */
    public function create(PesertaMagang $peserta)
    {
        return view('jurnal.create', compact('peserta'));
    }

    /**
     * Menyimpan jurnal
     */
    public function store(Request $request, PesertaMagang $peserta)
    {
        $request->validate([
            'jurnal' => 'required|file|mimes:pdf|max:10240',
        ], [
            'jurnal.required' => 'File jurnal wajib dipilih.',
            'jurnal.file' => 'File yang dipilih tidak valid.',
            'jurnal.mimes' => 'Jurnal harus berupa file PDF.',
            'jurnal.max' => 'Ukuran file maksimal 10 MB.',
        ]);

        // Jika peserta sudah punya jurnal,
        // hapus file lama terlebih dahulu
        if ($peserta->jurnal) {

            if (
                $peserta->jurnal->file_path &&
                Storage::disk('public')->exists(
                    $peserta->jurnal->file_path
                )
            ) {
                Storage::disk('public')->delete(
                    $peserta->jurnal->file_path
                );
            }

            $peserta->jurnal->delete();
        }

        $file = $request->file('jurnal');

        $path = $file->store(
            'jurnal',
            'public'
        );

        Jurnal::create([
            'peserta_magang_id' => $peserta->id,
            'nama_file' => $file->getClientOriginalName(),
            'file_path' => $path,
            'tanggal_upload' => now(),
        ]);

        return redirect()
            ->route('jurnal.index')
            ->with(
                'success',
                'Jurnal ' . $peserta->nama . ' berhasil diupload.'
            );
    }

    /**
     * Download jurnal
     */
    public function download(Jurnal $jurnal)
    {
        if (
            !Storage::disk('public')->exists(
                $jurnal->file_path
            )
        ) {
            return back()->withErrors([
                'jurnal' => 'File jurnal tidak ditemukan.'
            ]);
        }

        return Storage::disk('public')->download(
            $jurnal->file_path,
            $jurnal->nama_file
        );
    }

    public function view(Jurnal $jurnal)
    {
    $path = storage_path('app/public/' . $jurnal->file_path);

    if (!file_exists($path)) {
        abort(404, 'File jurnal tidak ditemukan.');
    }

    return response()->file($path);
    }

    /**
     * Menghapus jurnal
     */
    public function destroy(Jurnal $jurnal)
    {
        if (
            $jurnal->file_path &&
            Storage::disk('public')->exists(
                $jurnal->file_path
            )
        ) {
            Storage::disk('public')->delete(
                $jurnal->file_path
            );
        }

        $jurnal->delete();

        return redirect()
            ->route('jurnal.index')
            ->with(
                'success',
                'Jurnal berhasil dihapus.'
            );
    }
    public function updateNilai(Request $request, Jurnal $jurnal)
{
    $request->validate([
        'nilai' => 'required|integer|min:0',
    ]);

    $jurnal->update([
        'nilai' => $request->nilai,
    ]);

    return redirect()
        ->route('jurnal.index')
        ->with('success', 'Nilai jurnal berhasil disimpan.');
}
}