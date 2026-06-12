@extends('layouts.admin')
@section('title', 'Pelamar')
@section('page-title', 'Pelamar')
@section('breadcrumb', 'Content / Career / ' . $career->title . ' / Pelamar')

@section('topbar-actions')
    <a href="{{ route('admin.careers.index') }}" class="cms-btn">Kembali</a>
@endsection

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Email</th>
                <th>Tanggal Melamar</th>
                <th>CV</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
                <tr>
                    <td>{{ $application->email }}</td>
                    <td>{{ $application->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.careers.applications.download', [$career, $application]) }}" class="cms-btn cms-btn-sm">Download CV</a>
                    </td>
                    <td class="cms-actions">
                        <form method="POST" action="{{ route('admin.careers.applications.destroy', [$career, $application]) }}" onsubmit="return confirm('Hapus lamaran ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="cms-empty">Belum ada pelamar.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $applications->links() }}</div>
</div>
@endsection