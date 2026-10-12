
@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('breadcrumb', 'Manajemen Pengguna')

@php($activeMenu = 'users')

@section('content')
<div class="users-page">
    <style>
        .users-page { color: #182230; }
        .users-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
        }
        .users-header h1 {
            font-size: 25px;
            font-weight: 750;
            margin: 0 0 7px;
        }
        .users-header p {
            margin: 0;
            color: #778399;
            font-size: 14px;
        }
        .users-count {
            background: #edf1ff;
            color: #315cf5;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }
        .users-card {
            background: #fff;
            border: 1px solid #e9edf4;
            border-radius: 16px;
            overflow: hidden;
        }
        .users-filters {
            display: flex;
            gap: 12px;
            padding: 20px;
            border-bottom: 1px solid #e9edf4;
        }
        .users-filters input,
        .users-filters select {
            min-width: 0;
            padding: 11px 13px;
            border: 1px solid #e0e6ef;
            border-radius: 9px;
            background: #fff;
            color: #182230;
            font: inherit;
        }
        .users-filters input { flex: 1; }
        .users-btn {
            padding: 11px 16px;
            border: 0;
            border-radius: 9px;
            background: #315cf5;
            color: white;
            font-weight: 650;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .users-btn-secondary {
            background: #f1f4f9;
            color: #445066;
        }
        .users-table-wrap { overflow-x: auto; }
        .users-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }
        .users-table th {
            background: #f8f9fc;
            color: #778399;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .06em;
            font-weight: 700;
        }
        .users-table th,
        .users-table td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #edf0f5;
        }
        .users-table td { font-size: 13px; }
        .users-table tbody tr:last-child td { border-bottom: 0; }
        .users-identity {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .users-avatar {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: #edf1ff;
            color: #315cf5;
            font-weight: 750;
        }
        .users-name { font-weight: 700; margin-bottom: 4px; }
        .users-email { color: #778399; font-size: 12px; }
        .users-role {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            background: #f1f4f9;
            color: #536078;
            font-size: 11px;
            font-weight: 700;
        }
        .users-role-admin { background: #f0eaff; color: #7041c6; }
        .users-role-moderator { background: #fff4df; color: #9b6700; }
        .users-role-user { background: #e7f8ef; color: #18794e; }
        .users-action { color: #315cf5; font-weight: 700; text-decoration: none; }
        .users-empty {
            padding: 42px 20px;
            text-align: center;
            color: #778399;
        }
        .users-footer {
            padding: 16px 20px;
            border-top: 1px solid #e9edf4;
        }
        .users-footer nav p { margin: 0; }
        .users-footer nav div { display: flex; gap: 5px; flex-wrap: wrap; }
        .users-footer nav a,
        .users-footer nav span {
            display: inline-block;
            padding: 7px 11px;
            border: 1px solid #e0e6ef;
            border-radius: 7px;
            font-size: 12px;
            text-decoration: none;
        }
        .users-footer nav span[aria-current="page"] span {
            background: #315cf5;
            color: white;
            border-color: #315cf5;
        }
        @media (max-width: 650px) {
            .users-header { flex-direction: column; }
            .users-filters { flex-direction: column; }
            .users-filters select,
            .users-filters .users-btn { width: 100%; }
        }
    </style>

    <div class="users-header">
        <div>
            <h1>Manajemen Pengguna</h1>
            <p>Lihat dan telusuri akun yang terdaftar di WASPADA.</p>
        </div>

        <div class="users-count">
            {{ $users->total() }} pengguna
        </div>
    </div>

    <div class="users-card">
        <form method="GET"
              action="{{ route('admin.users.index') }}"
              class="users-filters">

            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau email..."
                aria-label="Cari nama atau email">

            <select name="role" aria-label="Filter role">
                <option value="">Semua role</option>
                <option value="user" @selected(request('role') === 'user')>
                    User
                </option>
                <option value="moderator" @selected(request('role') === 'moderator')>
                    Moderator
                </option>
                <option value="admin" @selected(request('role') === 'admin')>
                    Admin
                </option>
            </select>

            <button class="users-btn" type="submit">Cari</button>

            @if(request()->hasAny(['search', 'role']))
                <a href="{{ route('admin.users.index') }}"
                   class="users-btn users-btn-secondary">
                    Reset
                </a>
            @endif
        </form>

        <div class="users-table-wrap">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="users-identity">
                                    <div class="users-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <div class="users-name">
                                            {{ $user->name }}
                                        </div>
                                        <div class="users-email">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="users-role
                                    {{ $user->role === 'admin' ? 'users-role-admin' : '' }}
                                    {{ $user->role === 'moderator' ? 'users-role-moderator' : '' }}
                                    {{ $user->role === 'user' ? 'users-role-user' : '' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td>
                                {{ $user->created_at?->format('d M Y') ?? '—' }}
                            </td>

                            <td>
                                <a class="users-action"
                                   href="{{ route('admin.users.show', $user) }}">
                                    Detail →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="users-empty">
                                    <strong>Tidak ada pengguna ditemukan</strong>
                                    <p>Coba ubah kata kunci atau filter role.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="users-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
