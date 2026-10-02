@extends('layouts.admin')

@section('title', 'Edit Akun User')

@section('content')
<div style="max-width: 650px; margin: 0 auto; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    
    <!-- CARD FORM EDIT AKUN -->
    <div style="background: #ffffff; padding: 32px 36px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-top: 20px;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
            <span style="font-size: 22px; color: #1e3a8a;">✏️</span>
            <h2 style="color: #1e3a8a; font-size: 20px; font-weight: 700; margin: 0;">Edit Akun User</h2>
        </div>
        <p style="color: #64748b; font-size: 13.5px; margin-top: 0; margin-bottom: 24px;">
            Perbarui data akun <strong>{{ $user->name }}</strong> di bawah ini.
        </p>

        <!-- Form Edit Input -->
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 18px;">
                <label style="display:block; font-size:13px; font-weight:700; color:#1e293b; margin-bottom:8px;">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width:100%; padding:10px 14px; border:1px solid #e2e8f0; border-radius:10px; font-size:14px; color:#334155; outline:none; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display:block; font-size:13px; font-weight:700; color:#1e293b; margin-bottom:8px;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width:100%; padding:10px 14px; border:1px solid #e2e8f0; border-radius:10px; font-size:14px; color:#334155; outline:none; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 18px;">
                <label style="display:block; font-size:13px; font-weight:700; color:#1e293b; margin-bottom:8px;">Password Baru (Kosongkan jika tidak diubah)</label>
                <input type="password" name="password" placeholder="Password baru..." style="width:100%; padding:10px 14px; border:1px solid #e2e8f0; border-radius:10px; font-size:14px; color:#334155; outline:none; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display:block; font-size:13px; font-weight:700; color:#1e293b; margin-bottom:8px;">Role / Hak Akses</label>
                <select name="role" required style="width:100%; padding:10px 14px; border:1px solid #e2e8f0; border-radius:10px; font-size:14px; color:#334155; outline:none; background:white; font-weight:600; cursor:pointer; box-sizing: border-box;">
                    <option value="operator" {{ strtolower($user->role) == 'operator' ? 'selected' : '' }}>Operator</option>
                    <option value="admin" {{ strtolower($user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
                <a href="{{ route('admin.users.index') }}" style="background: #f1f5f9; color: #475569; padding: 10px 18px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 13.5px;">
                    Batal
                </a>
                <button type="submit" style="background: #1d4ed8; color: white; border: none; padding: 10px 20px; border-radius: 10px; cursor: pointer; font-weight: 700; font-size: 13.5px;">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection