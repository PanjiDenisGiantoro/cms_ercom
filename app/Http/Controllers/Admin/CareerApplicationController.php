<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CareerApplicationController extends Controller
{
    public function index(Career $career): View
    {
        $applications = $career->applications()->latest()->paginate(15);

        return view('admin.careers.applications.index', compact('career', 'applications'));
    }

    public function download(Career $career, CareerApplication $application): Response
    {
        return Storage::disk('public')->download($application->cv);
    }

    public function destroy(Career $career, CareerApplication $application): RedirectResponse
    {
        Storage::disk('public')->delete($application->cv);
        $application->delete();

        return back()->with('success', 'Application deleted.');
    }
}
