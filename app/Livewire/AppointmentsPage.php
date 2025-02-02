<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Database;
use Livewire\Attributes\Title;
use Livewire\Component;

class AppointmentsPage extends Component
{

    #[Title('PawSome|Appointments')]

    public $name, $pet_name, $drop_off_date, $pick_up_date, $health, $notes;
    protected $database;
    protected $tablename = "Appointments";

    public function boot(Database $database){
        $this->database = $database;
        $this->name = Auth::user() ? Auth::user()->name : '';
    }

    public function submit(){
        $this->validate( [
            'pet_name' => 'required|string',
            'drop_off_date' => 'required|date',
            'pick_up_date' => 'required|date|after:drop_off_date',
            'health' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $userId = Auth::user() ? Auth::user()->id : null;

        $postData = [
            'name' => $this->name,
            'pet_name' => $this->pet_name,
            'user_id' => $userId,
            'drop_off_date' => $this->drop_off_date,
            'pick_up_date' => $this->pick_up_date,
            'health' => $this->health,
            'notes' => $this->notes,
            'created_at' => Carbon::now()->toDateTimeString(),
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if ($postRef) {
            session()->flash('success', 'Appointment created successfully.');
            $this->reset(['pet_name', 'drop_off_date', 'pick_up_date', 'health', 'notes']);
        } else {
            session()->flash('error', 'Failed to confirm the appointment. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.appointments-page');
    }
}
