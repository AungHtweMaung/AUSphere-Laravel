<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileService;
use App\Models\AcademicCalendar;
use App\Http\Requests\AcademicCalendarRequest;

class AcademicCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all academic calendars
        $academicCalendars = AcademicCalendar::paginate(5);

        // Return the view with the academic calendars
        return view('acamedic-calendars.index', compact('academicCalendars'));
        // return view('department-types.index'); // IGNORE
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('acamedic-calendars.create');
        // return view('department-types.create'); // IGNORE
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicCalendarRequest $request)
    {
        // Validate the request
        $data = $request->validated();

        if ($request->hasFile('calendar_file')) {
            $filePath = (new FileService())->storeImage($request->calendar_file, 'academic-calendars');
            $data['calendar_file'] = $filePath;
        }

        // Create the academic calendar record
        AcademicCalendar::create($data);

        // Redirect or return a response
        return response()->json([
                'success' => 'Academic Calendar Created Successfully.',
                'redirectUrl' => route('academic-calendars.index')
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicCalendar $academic_calendar)
    {
        // Return the view with the academic calendar data
        return view('acamedic-calendars.show', compact('academic_calendar'));
        // return view('department-types.show'); // IGNORE
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicCalendar $academic_calendar)
    {
        // Return the edit view with the academic calendar data
        return view('acamedic-calendars.edit', compact('academic_calendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicCalendarRequest $request, AcademicCalendar $academic_calendar)
    {
        $data = $request->validated();

        try {
            if ($request->hasFile('calendar_file')) {
                // Delete the old image if it exists
                (new FileService())->deleteImage($academic_calendar->calendar_file ?? '');
                $filePath = (new FileService())->storeImage($request->calendar_file, 'academic-calendars');
                $data['calendar_file'] = $filePath;
            }
            $data['title'] = $request->title;
            // Update the academic calendar record
            $academic_calendar->update($data);

            return response()->json([
                'success' => 'Academic Calendar Updated Successfully.',
                'redirectUrl' => route('academic-calendars.index')
            ]);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json([
                'error' => 'An error occurred while updating the academic calendar.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
