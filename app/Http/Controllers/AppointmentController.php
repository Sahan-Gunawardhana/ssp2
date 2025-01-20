<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    
    public function index()
    {
        $appointment = Appointment::with(['customer'])->paginate(10);
        return AppointmentResource::collection($appointment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'pet_name' => 'required|string|max:255',
            'drop_off_date' => 'required|date_format:Y-m-d',
            'pick_up_date' => 'required|date_format:Y-m-d',
            'description' => 'nullable|string',
            'status' => 'required|string|in:upcoming,passed',
        ]);

        $appointment = Appointment::create($validated);
        return new AppointmentResource($appointment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appointment = Appointment::with(['customer'])->findOrFail($id);
        return new AppointmentResource($appointment);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $validated = $request->validate([
    //         'customer_id' => 'required|exists:users,id',
    //         'pet_name' => 'required|string|max:255',
    //         'drop_off_date' => 'required|date_format:Y-m-d',
    //         'pick_up_date' => 'required|date_format:Y-m-d',
    //         'description' => 'nullable|string',
    //         'status' => 'required|string|in:upcoming,passed',
    //     ]);

    //     $appointment = Appointment::findOrFail($id);
    //     $appointment->update($validated);
    //     return new AppointmentResource($appointment);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully'], 200);
    }
}
