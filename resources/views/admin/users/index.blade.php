@extends('layouts.admin')

@section('title', 'Tambah Akun Operator/Admin')

@section('content')
<div style="max-width: 950px; margin: 0 auto; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    
    <!-- CARD FORM TAMBAH AKUN -->
    <div style="background: #ffffff; padding: 32px 36px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 28px;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
            <span style="font-size: 22px; color: #1e3a8a;">👤</span>
            <h2 style="color: #1e3a8a; font-size: 20px; font-weight: 700; margin: 0;">Tambah Akun Operator/Admin</h2>
        </div>
        <p style="color: #64748b; font-size: 13.5px; margin-top: 0; margin-bottom: 24px;">
            Isi formulir di bawah ini untuk membuat akses akun Operator/Admin baru ke SIMAMANG.
        </p>

        <!-- Notifikasi Berhasil -->
        @if(session('success'))
            <div style="background: #e6fffa; color: #234e52; border: 1px solid #b2f5ea; padding: 12px 16px; border-radius: 10px; font-size: 13.5px; margin-bottom: 20px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Form Input -->
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 18px;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:700; color:#1e293b; margin-bottom:8px;">Nama Lengkap Operator/Admin</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Operator Magang" style="width:100%; padding:10px 14px; border:1px solid #e2e8f0; border-radius:10px; font-size:14px; color:#334155; outline:none; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:700; color:#1e293b; margin-bottom:8px;">Email Operator/Admin</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="operator@simamang.com" style="width:100%; padding:10px 14px; border:1px solid #e2e8f0; border-radius:10px; font-size:14px; color:#334155; outline:none; box-sizing: border-box;">
                </div>
            </div>

            <div style="margin-bottom: 22px;">
                <label style="display:block; font-size:13px; font-weight:700; color:#1e293b; margin-bottom:8px;">Password</label>
                <div style="position: relative; width: 100%;">
                    <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter" style="width:100%; padding:10px 45px 10px 14px; border:1px solid #e2e8f0; border-radius:10px; font-size:14px; color:#334155; outline:none; box-sizing: border-box;">
                    <button type="button" onclick="togglePassword()" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 0;">
                        <span id="eye-icon" style="font-size: 16px; opacity: 0.8;">👁️</span>
                    </button>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 14px;">
                <button type="submit" style="background: #1d4ed8; color: white; border: none; padding: 10px 20px; border-radius: 10px; cursor: pointer; font-weight: 700; font-size: 13.5px;">
                    + Buat Akun
                </button>

                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 13px; font-weight: 700; color: #475569;">Role:</span>
                    <select name="role" required style="padding: 9px 12px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 13.5px; color: #334155; outline: none; background: white; font-weight: 600; cursor: pointer;">
                        <option value="operator" selected>Operator</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- CARD TABEL DAFTAR USER -->
    <div style="background: #ffffff; padding: 32px 36px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
        <h3 style="color: #1e3a8a; margin-top: 0; margin-bottom: 20px; font-size: 17px; font-weight: 700;">Daftar Akun User Saat Ini</h3>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; text-align: left; color: #475569; font-size: 13px;">
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; width: 8%; font-weight: 700;">No</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 700;">Nama User</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; font-weight: 700;">Email</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; width: 15%; font-weight: 700;">Role</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: center; width: 18%; font-weight: 700;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px; color: #334155;">
                    @forelse($users as $index => $user)
                    <tr>
                        <td style="padding: 14px 16px; border-bottom: 1px solid #f1f5f9; color: #64748b;">{{ $index + 1 }}</td>
                        <td style="padding: 14px 16px; border-bottom: 1px solid #f1f5f9; font-weight: 700; color: #0f172a;">{{ $user->name }}</td>
                        <td style="padding: 14px 16px; border-bottom: 1px solid #f1f5f9; color: #334155;">{{ $user->email }}</td>
                        <td style="padding: 14px 16px; border-bottom: 1px solid #f1f5f9;">
                            @if(strtolower($user->role) == 'admin')
                                <span style="background-color: #f3e8ff; color: #7e22ce; border: 1px solid #e9d5ff; font-weight: 700; font-size: 10.5px; padding: 4px 14px; border-radius: 20px; display: inline-block;">
                                    ADMIN
                                </span>
                            @else
                                <span style="background-color: #fef3c7; color: #d97706; border: 1px solid #fde68a; font-weight: 700; font-size: 10.5px; padding: 4px 14px; border-radius: 20px; display: inline-block;">
                                    OPERATOR
                                </span>
                            @endif
                        </td>
                        <td style="padding: 14px 16px; border-bottom: 1px solid #f1f5f9; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 8px;">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" style="background-color: #fef3c7; color: #d97706; border: none; padding: 6px 16px; font-size: 13px; font-weight: 700; border-radius: 8px; text-decoration: none;">
                                    Edit
                                </a>

                                <!-- Tombol Hapus (Panggil Modal via Function) -->
                                <button type="button" onclick="openDeleteModal({{ $user->id }})" style="background-color: #ffe4e6; color: #e11d48; border: none; padding: 6px 16px; font-size: 13px; font-weight: 700; border-radius: 8px; cursor: pointer;">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 24px; text-align: center; color: #94a3b8;">Belum ada akun user yang dibuat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL POPUP HAPUS OVERLAY -->
@foreach($users as $user)
<div id="customDeleteModal{{ $user->id }}" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: white; border-radius: 20px; padding: 30px 24px; text-align: center; width: 100%; max-width: 380px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
        
        <!-- IKON SERUAN KUNING -->
        <div style="width: 75px; height: 75px; border: 4px solid #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px auto;">
            <span style="font-size: 42px; color: #f59e0b; font-weight: bold; line-height: 1;">!</span>
        </div>

        <!-- JUDUL MODAL -->
        <h3 style="color: #1e3a8a; font-weight: 800; font-size: 20px; margin: 0 0 8px 0; text-transform: uppercase;">
            HAPUS USER
        </h3>

        <!-- SUB JUDUL -->
        <p style="color: #64748b; font-size: 14px; margin: 0 0 24px 0;">
            Yakin ingin menghapus user ini?
        </p>

        <!-- TOMBOL AKSI -->
        <div style="display: flex; justify-content: center; gap: 10px;">
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" style="background-color: #dc2626; color: white; border: none; padding: 10px 22px; font-size: 13.5px; font-weight: 700; border-radius: 10px; cursor: pointer;">
                    Ya, hapus
                </button>
            </form>

            <button type="button" onclick="closeDeleteModal({{ $user->id }})" style="background-color: #94a3b8; color: white; border: none; padding: 10px 22px; font-size: 13.5px; font-weight: 700; border-radius: 10px; cursor: pointer;">
                Batal
            </button>
        </div>

    </div>
</div>
@endforeach

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.textContent = '🙈';
        } else {
            passwordInput.type = 'password';
            eyeIcon.textContent = '👁️';
        }
    }

    function openDeleteModal(id) {
        document.getElementById('customDeleteModal' + id).style.display = 'flex';
    }

    function closeDeleteModal(id) {
        document.getElementById('customDeleteModal' + id).style.display = 'none';
    }
</script>
@endsection