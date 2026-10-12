@extends('layouts.admin')

@section('title', 'Detail Pengguna')
@section('breadcrumb', 'Manajemen Pengguna / Detail')

@php($activeMenu = 'users')

@section('content')
    @if (session('success'))
        <div style="padding: 14px 16px; margin-bottom: 18px; border-radius: 10px; background: #e7f8ef; color: #18794e;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="padding: 14px 16px; margin-bottom: 18px; border-radius: 10px; background: #fff0f0; color: #b42318;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="padding: 14px 16px; margin-bottom: 18px; border-radius: 10px; background: #fff0f0; color: #b42318;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <div class="user-detail-page">
        <style>
            .user-detail-page {
                color: #182230;
            }

            .detail-heading {
                margin-bottom: 24px;
            }

            .detail-heading h1 {
                font-size: 25px;
                font-weight: 750;
                margin: 0 0 7px;
            }

            .detail-heading p {
                color: #778399;
                font-size: 14px;
                margin: 0;
            }

            .detail-card {
                background: #fff;
                border: 1px solid #e9edf4;
                border-radius: 16px;
                padding: 26px;
                margin-bottom: 20px;
            }

            .detail-identity {
                display: flex;
                align-items: center;
                gap: 18px;
                padding-bottom: 24px;
                border-bottom: 1px solid #edf0f5;
                margin-bottom: 24px;
            }

            .detail-avatar {
                width: 66px;
                height: 66px;
                flex-shrink: 0;
                display: grid;
                place-items: center;
                border-radius: 18px;
                background: #edf1ff;
                color: #315cf5;
                font-size: 26px;
                font-weight: 750;
            }

            .detail-identity h2 {
                font-size: 20px;
                margin: 0 0 6px;
                font-weight: 750;
            }

            .detail-identity p {
                color: #778399;
                margin: 0;
                font-size: 13px;
            }

            .detail-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 22px;
            }

            .detail-field label {
                display: block;
                color: #778399;
                font-size: 12px;
                margin-bottom: 8px;
            }

            .detail-field div {
                font-size: 14px;
                font-weight: 650;
                overflow-wrap: anywhere;
            }

            .detail-role {
                display: inline-block;
                background: #e7f8ef;
                color: #18794e;
                border-radius: 20px;
                padding: 6px 11px;
                font-size: 12px;
                font-weight: 700;
            }

            .detail-role.admin {
                background: #f0eaff;
                color: #7041c6;
            }

            .detail-role.moderator {
                background: #fff4df;
                color: #9b6700;
            }

            .detail-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                margin-top: 24px;
            }

            .detail-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 11px 16px;
                border-radius: 9px;
                background: #315cf5;
                color: white;
                text-decoration: none;
                font-size: 13px;
                font-weight: 700;
            }

            .detail-btn.secondary {
                background: #f1f4f9;
                color: #445066;
            }

            @media (max-width: 600px) {
                .detail-card {
                    padding: 20px;
                }

                .detail-grid {
                    grid-template-columns: 1fr;
                    gap: 18px;
                }

                .detail-identity {
                    align-items: flex-start;
                }
            }

            .role-settings {
                margin-top: 28px;
                padding: 22px;
                border: 1px solid #e9edf4;
                border-radius: 14px;
                background: #f8f9fc;
            }

            .role-settings-heading {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                margin-bottom: 22px;
            }

            .role-settings-icon {
                width: 40px;
                height: 40px;
                flex-shrink: 0;
                display: grid;
                place-items: center;
                border-radius: 11px;
                background: #edf1ff;
                color: #315cf5;
                font-size: 20px;
            }

            .role-settings-heading h3 {
                margin: 0 0 6px;
                font-size: 15px;
                font-weight: 750;
            }

            .role-settings-heading p {
                margin: 0;
                color: #778399;
                font-size: 13px;
                line-height: 1.6;
            }

            .role-settings-form {
                display: flex;
                align-items: flex-end;
                gap: 14px;
                flex-wrap: wrap;
            }

            .role-settings-field {
                flex: 1;
                min-width: 180px;
            }

            .role-settings-field label {
                display: block;
                margin-bottom: 8px;
                color: #536078;
                font-size: 12px;
                font-weight: 650;
            }

            .role-settings-field select {
                width: 100%;
                padding: 12px;
                border: 1px solid #e0e6ef;
                border-radius: 9px;
                background: #fff;
                color: #182230;
                font: inherit;
            }

            .role-settings-form .detail-btn {
                border: none;
                cursor: pointer;
            }

            @media (max-width: 520px) {
                .role-settings-form {
                    align-items: stretch;
                    flex-direction: column;
                }

                .role-settings-form .detail-btn {
                    width: 100%;
                }
            }
        </style>

        <div class="detail-heading">
            <h1>Detail Pengguna</h1>
            <p>Informasi akun yang terdaftar di sistem WASPADA.</p>
        </div>

        <div class="detail-card">
            <div class="detail-identity">
                <div class="detail-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div class="detail-grid">
                <div class="detail-field">
                    <label>ID Pengguna</label>
                    <div>#{{ $user->id }}</div>
                </div>

                <div class="detail-field">
                    <label>Role</label>
                    <div>
                        <span class="detail-role {{ $user->role }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                <div class="detail-field">
                    <label>Tanggal Registrasi</label>
                    <div>
                        {{ $user->created_at?->format('d F Y, H:i') ?? '—' }}
                    </div>
                </div>

                <div class="detail-field">
                    <label>Terakhir Diperbarui</label>
                    <div>
                        {{ $user->updated_at?->format('d F Y, H:i') ?? '—' }}
                    </div>
                </div>
            </div>


            @if (auth()->id() !== $user->id)
                <div class="role-settings">
                    <div class="role-settings-heading">
                        <div class="role-settings-icon">♙</div>

                        <div>
                            <h3>Pengaturan Hak Akses</h3>
                            <p>
                                Ubah tingkat akses akun sesuai tanggung jawab pengguna.
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('admin.users.role.update', $user) }}" method="POST" class="role-settings-form">
                        @csrf
                        @method('PATCH')

                        <div class="role-settings-field">
                            <label for="role">Role Baru</label>

                            <select name="role" id="role" required>
                                <option value="user" @selected($user->role === 'user')>
                                    User
                                </option>
                                <option value="moderator" @selected($user->role === 'moderator')>
                                    Moderator
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="detail-btn"
                            onclick="return confirm('Yakin ingin mengubah role pengguna ini?')">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            @endif


            <div class="detail-actions">
                <a href="{{ route('admin.users.index') }}" class="detail-btn secondary">
                    ← Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
@endsection
