@extends('layouts.sidebar')
@section('content')
<h2 class="px-2 text-4xl font-semibold text-gray-800 py-14">Manager Appointments</h2>
<div class="relative flex flex-col w-full h-full px-2 text-white bg-white rounded-lg shadow-md poverflow-scroll bg-clip-border">
    <table class="w-full overflow-auto text-left rounded-lg" id="orders-table">
        <thead class="text-lg bg-gray-800 rounded-t-lg">
            <tr class="text-lg text-left">
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    #
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Customer Name
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Pet Name
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Drop Off Date
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Pick Up Date
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Health Condition
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Notes
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            
            @php $i=1;  @endphp
            @forelse ($appointments as $key => $item)
            <tr class="bg-teal-600 border-b border-gray-200 hover:bg-teal-800">
                <td class="px-4 py-3 font-medium text-white border-r text-normal">
                    {{$i ++}}
                </td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">
                    {{$item['name']}}
                </td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">
                    {{$item['pet_name']}}
                </td>
                <td
                    class="px-4 py-3 font-medium border-r text-normal 
                    {{ \Carbon\Carbon::parse($item['drop_off_date'])->isPast() ? 'bg-red-200 text-black' : 'bg-green-200 text-black' }}">
                    {{$item['drop_off_date']}}
                </td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">
                    {{$item['pick_up_date']}}
                </td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">
                    {{$item['health']}}
                </td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">
                    {{$item['notes']}}
                </td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">
                    <button onclick="confirmDelete('{{$key}}')" class="text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed" stroke="#000" stroke-width="2">
                            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                        </svg>
                    </button>
                </td>
                <script>
                    function confirmDelete(id) {
                        // Display SweetAlert confirmation
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to undo this action!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#439288',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // If confirmed, make the AJAX request to delete the appointment
                                deleteAppointment(id);
                            }
                        });
                    }
                    function deleteAppointment(id) {
                        // Make an AJAX request to delete the appointment
                        fetch(`/delete-appointment/${id}`, {
                            method: 'GET',
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // If deletion was successful, show success SweetAlert
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Appointment deleted successfully.',
                                    icon: 'success',
                                    confirmButtonColor: '#439288',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.reload(); // Reload the page to reflect the changes
                                });
                            } else {
                                // If something went wrong, show error SweetAlert
                                Swal.fire({
                                    title: 'Oops!',
                                    text: 'Something went wrong. Please try again.',
                                    icon: 'error',
                                    confirmButtonColor: '#439288',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Try Again'
                                });
                            }
                        })
                        .catch(error => {
                            // If an error occurred during the request, show error SweetAlert
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred. Please try again.',
                                icon: 'error',
                                confirmButtonColor: '#439288',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Close'
                            });
                        });
                    }
                </script>
            </tr>
            @empty
            <td colspan="8" class="py-6 text-center text-white bg-teal-600">
                Loading...
            </td>
            @endforelse
        </tbody>
    </table>
</div>



{{-- 
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
</script> --}}
@endsection