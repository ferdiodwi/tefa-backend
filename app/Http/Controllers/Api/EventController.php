<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    /**
     * Terapkan middleware otentikasi untuk semua metode KECUALI
     * 'index' (Get Events) dan 'show' (Get Events by Id)
     * Ini sudah sesuai dengan pengaturan "Auth: noauth" di Postman.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Menampilkan daftar event.
     * Cocok dengan request "Get Events" di Postman.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Menangani query parameter ?search=...
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Menangani query parameter lain jika ada (misal: filter, sort)
        // ... (logika lain bisa ditambahkan di sini)

        // Menangani paginasi dengan ?page=... dan ?per_page=...
        // Postman menyebutkan default 20, kita bisa set di sini.
        $perPage = $request->get('per_page', 20);
        $events = $query->latest()->paginate($perPage);

        return EventResource::collection($events);
    }

    /**
     * Menyimpan event baru.
     * Cocok dengan request "Store Events" di Postman.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'status' => 'required|in:draft,published',
        ]);

        // Secara otomatis mengisi organizer_id dari user yang sedang login
        $validated['organizer_id'] = auth()->id();

        $event = Event::create($validated);

        return new EventResource($event);
    }

    /**
     * Menampilkan detail satu event.
     * Cocok dengan request "Get Events by Id" di Postman.
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Mengupdate event.
     * Cocok dengan request "Update Events" di Postman.
     */
    public function update(Request $request, Event $event)
    {
        if (Gate::denies('manage-event', $event)) {
            return response()->json(['error' => 'Forbidden. You do not own this event.'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'venue' => 'sometimes|required|string|max:255',
            'start_datetime' => 'sometimes|required|date',
            'end_datetime' => 'sometimes|required|date|after:start_datetime',
            'status' => 'sometimes|required|in:draft,published',
        ]);

        $event->update($validated);

        return new EventResource($event);
    }

    /**
     * Menghapus event.
     * Cocok dengan request "Delete Events" di Postman.
     */
    public function destroy(Event $event)
    {
        if (Gate::denies('manage-event', $event)) {
            return response()->json(['error' => 'Forbidden. You do not own this event.'], 403);
        }

        $event->delete();

        return response()->noContent(); // Standar response 204 untuk delete
    }
}
