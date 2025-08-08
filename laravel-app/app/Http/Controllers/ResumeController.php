<?php namespace App\Http\Controllers;
use PDF;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function create()
    {
        return view('resume.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'education' => 'required|string',
            'experience' => 'required|string',
            'skills' => 'required|string',
        ]);

        // Yahan tum PDF generate kar sakte ho (dompdf / laravel-snappy)
        $pdf = \PDF::loadView('resume.pdf', $data);

        return $pdf->download('resume.pdf');
    }
}
