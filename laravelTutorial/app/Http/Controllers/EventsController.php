<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Trả JSON nếu là request từ JS
        if ($request->wantsJson()) {
            $events = Events::where('is_public', 1)->orderBy('created_at', 'desc')->paginate(5);
            $events->transform(function ($event) {
                $event->image = $event->image;
                return $event;
            });

            return response()->json([
                'events' => $events,
            ]);
        }
        return view('pages.events.events');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.events.create-event');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'name.required' => 'Tên sự kiện không được để trống.',
            'description.required' => 'Mô tả không được để trống.',
        ]);

        $event = Events::create([
            'name' => $request->name,
            'description' => $request->description,
            'video_id' => $request->video_id,
            'post_date' => $request->post_date,
            'author' => $request->author,
            'is_public' => $request->has('is_public') ? 1 : 0,
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('image')) {
            $event->addMedia($request->file('image'))
                ->toMediaCollection('event_images');
        }

        return redirect()->route('events.index')->with('success', 'Thêm sự kiện thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function showDetail($eventId, Request $request)
    {
        \Carbon\Carbon::setLocale('vi');
        $event = Events::find($eventId);
        if (!$event) {
            return redirect()->back()->with('error', 'Không tìm thấy sự kiện.');
        }

        if ($request->wantsJson()) {
            $event->image = $event->image;

            return response()->json([
                'event' => $event,
            ]);
        }

        $otherEvents = Events::where('id', '!=', $eventId)
            ->latest()
            ->take(5)
            ->get();
        return view('pages.events.detail-event')->with([
            'event' => $event,
            'otherEvents' => $otherEvents,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($eventId)
    {
        $event = Events::find($eventId);
        if (!$event) {
            return redirect()->back()->with('error', 'Không tìm thấy sự kiện.');
        }
        return view('pages.events.edit-event')->with([
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $eventId)
    {
        $event = Events::find($eventId);
        if (!$event) {
            return redirect()->back()->with('error', 'Không tìm thấy sự kiện.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'name.required' => 'Tên sự kiện không được để trống.',
            'description.required' => 'Mô tả không được để trống.',
        ]);

        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'video_id' => $request->video_id,
            'post_date' => $request->post_date,
            'author' => $request->author,
            'is_public' => $request->input('is_public'),
        ]);

        if ($request->hasFile('image')) {
            $event->clearMediaCollection('event_images');
            $event->addMedia($request->file('image'))
                ->toMediaCollection('event_images');
        }

        return redirect()->route('events.index')->with('success', 'Cập nhật sự kiện thành công.');
    }
}
