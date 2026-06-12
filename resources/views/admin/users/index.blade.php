@extends('layouts.admin')
@section('title', 'Users')
@section('page-title', 'Users')
@section('breadcrumb', 'System / Users')

@section('topbar-actions')
    <a href="{{ route('admin.users.create') }}" class="cms-btn cms-btn-primary">+ Tambah User</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr><th>Nama</th><th>Email</th><th>Role</th><th>Bergabung</th><th></th></tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->getRoleNames() as $role)
                            <span class="cms-badge {{ $role === 'admin' ? 'cms-badge-blue' : 'cms-badge-yellow' }}">{{ $role }}</span>
                        @endforeach
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.users.edit', $user) }}" class="cms-btn cms-btn-sm">Edit</a>
                        @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="cms-empty">Belum ada user.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $users->links() }}</div>
</div>
@endsection
