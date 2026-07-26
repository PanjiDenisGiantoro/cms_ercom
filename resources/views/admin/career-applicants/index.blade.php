@extends('layouts.admin')
@section('title', 'Pelamar')
@section('page-title', 'Pelamar')
@section('breadcrumb', 'Content / Career / Pelamar')

@section('content')
<div class="cms-card">
    <table class="cms-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Posisi</th>
                <th>Tanggal Melamar</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($applicants as $applicant)
                <tr>
                    <td><strong>{{ $applicant->name ?? '—' }}</strong></td>
                    <td>{{ $applicant->email }}</td>
                    <td>{{ $applicant->career?->title ?? '—' }}</td>
                    <td>{{ $applicant->created_at->format('d M Y H:i') }}</td>
                    <td class="cms-actions">
                        <a href="{{ route('admin.career-applicants.show', $applicant) }}" class="cms-btn cms-btn-sm">Detail</a>
                        <form method="POST" action="{{ route('admin.career-applicants.destroy', $applicant) }}" onsubmit="return confirm('Hapus lamaran ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="cms-btn cms-btn-sm cms-btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="cms-empty">Belum ada pelamar.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:16px">{{ $applicants->links() }}</div>
</div>
@endsection
