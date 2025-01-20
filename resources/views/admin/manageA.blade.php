@extends('layouts.sidebar')
@section('content')
<div class="w-full h-32 p-4 card">
    
    <form id="appointmentForm">
        @csrf
        <label for="pet_name">Pet Name:</label><br>
        <input type="text" id="pet_name" name="pet_name" placeholder="Enter pet's name" required><br><br>

        <label for="drop_off_date">Drop-off Date:</label><br>
        <input type="date" id="drop_off_date" name="drop_off_date" required><br><br>

        <label for="pick_up_date">Pick-up Date:</label><br>
        <input type="date" id="pick_up_date" name="pick_up_date" required><br><br>

        <label for="description">Notes:</label><br>
        <textarea id="description" name="description" placeholder="Enter additional notes (optional)"></textarea><br><br>

        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
        <button type="submit" class="p-4 border-4 border-black bg-blue-50 rounded-xl">Add Appointment</button>
    </form>
</div>


<script>
    const token = localStorage.getItem('authToken');
    let url = "http://127.0.0.1:8000/api/appointments";
    
    document.getElementById('appointmentForm').addEventListener('submit', async function(event){
        event.preventDefault();
        
        const userId = document.getElementById('user_id').value;
        const petName = document.getElementById('pet_name').value;
        const drop_off_date = document.getElementById('drop_off_date').value;
        const pick_up_date = document.getElementById('pick_up_date').value;
        const notes = document.getElementById('description').value;
        
        const appointmentData = {
            customer_id: userId,
            pet_name: petName,
            drop_off_date: drop_off_date,
            pick_up_date: pick_up_date,
            description: notes || null,
            status: 'upcoming'
        };

        
        if(petName && drop_off_date && pick_up_date){
            axios.post(url, appointmentData, {  
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then(response => {
                alert('Appointment created successfully!');
                location.reload(); 
            }).catch(error => {
                console.log('ERROR', error);
            });
        }
    });
</script>
@endsection