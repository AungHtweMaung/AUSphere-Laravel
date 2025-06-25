<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Http\Requests\EventRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::whereNull('deleted_at')
            ->filter()->paginate(10);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = (new FileService())->storeImage($request->image, 'events');
            $data['image'] = $imagePath;
        }
        // Handle start_time and end_time, allowing them to be null
        $data['start_time'] = $request->start_time ? Carbon::parse($request->start_time)->format('H:i:s') : null;
        $data['end_time'] = $request->end_time ? Carbon::parse($request->end_time)->format('H:i:s') : null;
        $data['user_id'] = auth()->user()->id;
        $data['location'] = $request->location ?? null;

        Event::create($data);

        return response()->json([
            'success'=>'Event Created Successfully',
            'redirectUrl' => route('events.index')
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();
        // Handle image replacement
        try {
            if ($request->hasFile('image')) {
            // Delete the old image if it exists
                (new FileService())->deleteImage($event->image ?? '');
                $imagePath = (new FileService())->storeImage($request->image, 'events');
                $data['image'] = $imagePath;
            }

            // Handle start_time and end_time, allowing them to be null
            // store time as hour min second fromat
            $data['date'] = $request->date ?? null;
            $data['start_time'] = $request->start_time ? Carbon::parse($request->start_time)->format('H:i:s') : null;
            $data['end_time'] = $request->end_time ? Carbon::parse($request->end_time)->format('H:i:s') : null;
            $data['location'] = $request->location ?? null;

            $event->update($data);

            return response()->json([
                'success' => 'Event Updated Successfully',
                'redirectUrl' => route('events.index')
            ]);
        }
        catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json([
                'error' => 'Failed to update event',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image) {
            (new FileService())->deleteImage($event->image);
        }
        $event->delete();

        return response()->json([
            'success' => 'Department Deleted Successfully.',
            'redirectUrl' => route('departments.index')
        ]);
    }
}
