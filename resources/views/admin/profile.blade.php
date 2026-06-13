@extends('layouts.admin')

@section('title', 'Profile & Ganti Password')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
    <!-- Kiri: Info Akun -->
    <div class="table-container">
        <h3 style="margin-bottom: 20px;"><i class="fas fa-info-circle"></i> Informasi Akun</h3>
        <div style="padding: 20px;">
            <div style="margin-bottom: 15px;">
                <label style="color: #64748b; font-size: 12px;">Username</label>
                <p style="font-size: 18px; font-weight: 600;">{{ $admin->username }}</p>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="color: #64748b; font-size: 12px;">Email</label>
                <p style="font-size: 18px; font-weight: 600;">{{ $admin->email }}</p>
            </div>
            <div>
                <label style="color: #64748b; font-size: 12px;">Member Sejak</label>
                <p style="font-size: 18px; font-weight: 600;">{{ $admin->created_at->format('d F Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Kanan: Ganti Password -->
    <div class="table-container">
        <h3 style="margin-bottom: 20px;"><i class="fas fa-lock"></i> Ganti Password</h3>
        <form method="POST" action="{{ route('admin.change-password') }}" style="padding: 20px;">
            @csrf
            <div class="form-group" style="margin-bottom: 20px;">
                <label>Password Saat Ini</label>
                <input type="password" name="current_password" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label>Password Baru</label>
                <input type="password" name="new_password" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;" required>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;" required>
            </div>
            <button type="submit" style="background: #2F6B5E; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
                <i class="fas fa-key"></i> Ganti Password
            </button>
        </form>
    </div>
</div>

<style>
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
    .form-control:focus { outline: none; border-color: #2F6B5E; box-shadow: 0 0 0 3px rgba(47,107,94,0.1); }
</style>
@endsection