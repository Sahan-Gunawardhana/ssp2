<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class AppointmentController extends Controller
{
    protected $database;
    protected $tablename;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'Appointments';
    }

    public function index(){
        return view ('user.appointments');
    }

    public function store(Request $request){
        $postData = [
            'name' => $request->input('name'),
            'pet_name' => $request->input('pet_name'),
            'userId' => $request->input('userId'),
            'drop_off_date' => $request->input('drop_off_date'),
            'pick_up_date' => $request->input('pick_up_date'),
            'health'=> $request->input('health'),
            'notes'=>$request->input('notes'),
            'created_at' => now()->toDateTimeString(),
        ];
        $postRef = $this->database->getReference($this->tablename)->push($postData);
        if ($postRef) {
            session()->flash('success', 'Appointment created successfully.');
            return redirect('appointments');
        } else {
            session()->flash('error', 'Failed to confirm the appointment. Please try again.');
            return redirect('appointments');
        }
    }

    public function adminIndex(){
        
        $appointments = $this->database->getReference($this->tablename)->getValue();
        $appointments = $appointments ?: [];
        return view('admin.manageA', compact('appointments'));
    }

    public function destroy( $id ){
        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();

        if ($del_data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
