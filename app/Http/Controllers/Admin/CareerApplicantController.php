<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CareerApplicantController extends Controller
{
    public function index(): View
    {
        $applicants = CareerApplication::with('career')->latest()->paginate(15);

        return view('admin.career-applicants.index', compact('applicants'));
    }

    public function show(CareerApplication $career_applicant): View
    {
        return view('admin.career-applicants.show', ['applicant' => $career_applicant]);
    }

    public function download(CareerApplication $career_applicant): Response
    {
        return Storage::disk('public')->download($career_applicant->cv);
    }

    public function destroy(CareerApplication $career_applicant): RedirectResponse
    {
        Storage::disk('public')->delete($career_applicant->cv);
        $career_applicant->delete();

        return redirect()->route('admin.career-applicants.index')->with('success', 'Application deleted.');
    }
}
