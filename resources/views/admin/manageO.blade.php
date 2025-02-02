@extends('layouts.sidebar')
@section('content')

<h2 class="px-2 text-4xl font-semibold text-gray-800 py-14">Manager Order</h2>
<div class="relative flex flex-col w-full px-2 overflow-auto text-white bg-white rounded-lg shadow-md bg-clip-border">
    <table class="w-full text-left rounded-lg" id="orders-table">
        <thead class="text-lg bg-gray-800 rounded-t-lg">
            <tr class="text-lg text-left">
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    #
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Customer Name
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Order Date
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Address
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Items
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Status
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Total
                </th>
                <th class="p-4 border-b border-white bg-blue-gray-50">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody id="orders-container">
            <tr class="even:bg-blue-gray-50/50">
                <td colspan="8" class="py-6 text-center text-white bg-teal-600">
                    Loading...
                </td>
            </tr>
        </tbody>
    </table>
</div>

<h2 class="px-2 text-4xl font-semibold text-gray-800 py-14">Subscriptions</h2>
<div class="relative flex flex-col w-full px-2 text-white bg-white rounded-lg shadow-md bg-clip-border">
    <table class="w-full text-left rounded-lg" id="boxes-table">
        <thead class="text-lg bg-gray-800 rounded-t-lg">
            <tr class="text-lg text-left">
                <th class="p-4 border-b border-white bg-blue-gray-50">#</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Customer Name</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Customer Address</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Items</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Status</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Total</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Actions</th>
            </tr>
        </thead>
        <tbody id="boxes-container">
            <tr class="even:bg-blue-gray-50/50">
                <td colspan="8" class="py-6 text-center text-white bg-teal-600">Loading...</td>
            </tr>
        </tbody>
        

        </div>
        
    </table>
    
</div>
<div class="mt-4">
<script>
    const token = localStorage.getItem('authToken');
    let url = "http://127.0.0.1:8000/api/orders";
    let url2 = "http://127.0.0.1:8000/api/boxes";
    document.addEventListener('DOMContentLoaded', function(){
        
        axios.get(url, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        })
        .then(response => {
            const orders = response.data.data;
            const ordersContainer = document.getElementById('orders-container');

            ordersContainer.innerHTML = orders.map((orders, index) => `
                <tr class="bg-teal-600 border-b border-gray-200 hover:bg-teal-800">
                    <td class="px-4 py-3 font-medium text-white border-r text-normal">${index + 1}</td>
                    <td class="px-4 py-3 font-medium text-white border-r text-normal">${orders.customer.name}</td>
                    <td class="px-4 py-3 font-medium text-white border-r text-normal">${orders.order_date}</td>
                    <td class="px-4 py-3 font-medium text-white border-r text-normal">${orders.street}, ${orders.city}, ${orders.province}, ${orders.zip_code}</td>
                    <td class="px-4 py-3 font-medium text-white border-r text-normal">
                        ${orders.orderItems ? orders.orderItems.map(
                        item => `${item.product.pro_name} x ${item.quantity}`
                        
                        ).join(`<hr class="mt-2 mb-2">`) : 'No items'}
                    </td>
                    <td class="px-4 py-3 font-medium text-white border-r text-normal">
                        <select role="menu"
                            class="text-white bg-gray-800 border border-gray-600 rounded-md p-auto status-dropdown focus:outline-none focus:ring-2 focus:ring-blue-500"
                            data-order-id="${orders.id}" onchange="updateStatus(event)">
                            <option value="pending" ${orders.status==='pending' ? 'selected' : '' }> Pending </option>
                            <option value="confirmed" ${orders.status==='confirmed' ? 'selected' : '' }> Confirmed </option>
                            <option value="shipped" ${orders.status==='shipped' ? 'selected' : '' }> Shipped </option>
                            <option value="canceled" ${orders.status==='canceled' ? 'selected' : '' }> Canceled </option>
                        </select>
                    </td>
                    <td class="px-4 py-3 font-medium text-white border-r text-normal">${orders.total}</td>
                    <td class="px-4">
                        <button onclick="deleteOrder(${orders.id})" class="text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed" stroke="#000" stroke-width="2">
                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                            </svg>
                        </button>
                    </td> 
                </tr>
            `).join('');
        })
        .catch(error=> {
            console.error(error);
        });

        axios.get(url2, {
    headers: {
        Authorization: `Bearer ${token}`
    }
})
.then(response => {
    const boxes = response.data.data;
    const boxesContainer = document.getElementById('boxes-container');

    boxesContainer.innerHTML = boxes.map((box, index) => `
        <tr class="bg-teal-600 border-b border-gray-200 hover:bg-teal-800">
            <td class="px-4 py-3 font-medium text-white border-r text-normal">${index + 1}</td>
            <td class="px-4 py-3 font-medium text-white border-r text-normal">${box.customer.name}</td>
            <td class="px-4 py-3 font-medium text-white border-r text-normal">${box.zip_code}, ${box.province}, ${box.city}, ${box.street}</td>
            <td class="px-4 py-3 font-medium text-white border-r text-normal">${box.boxItems.map(item => `${item.product.pro_name} x ${item.quantity}`).join('<hr class="mt-2 mb-2">')}</td>
            <td class="px-4 py-3 font-medium text-white border-r text-normal">
                <select role="menu" class="text-white bg-gray-800 border border-gray-600 rounded-md p-auto status-dropdown focus:outline-none focus:ring-2 focus:ring-blue-500"
                    data-box-id="${box.id}" onchange="updateStatus(event)">
                    <option value="1" ${box.status === 1 ? 'selected' : ''}>Active</option>
                    <option value="0" ${box.status === 0 ? 'selected' : ''}>Inactive</option>
                </select>
            </td>
            <td class="px-4 py-3 font-medium text-white border-r text-normal">${box.price}</td>
            <td class="px-4">
                <button onclick="deleteBox(${box.id})" class="text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed" stroke="#000" stroke-width="2">
                        <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                    </svg>
                </button>
            </td> 
        </tr>
    `).join('');
})
.catch(error => {
    console.error(error);
});
    });    

    function deleteOrder(orderId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this action!",
        icon: 'warning', 
        showCancelButton: true,
        confirmButtonColor: '#439288',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => { 
        if (result.isConfirmed) { 
            axios.delete(`${url}/${orderId}`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: "Deleted!",
                        text: "Order has been deleted",
                    }).then(() => { 
                        location.reload(); 
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "Failed to delete the order. Please try again."
                    });
                });
        }
    });
}

    function deleteBox(boxId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this action!",
            icon: 'warning', 
            showCancelButton: true,
            confirmButtonColor: '#439288',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => { 
            if (result.isConfirmed) { 
                axios.delete(`${url2}/${boxId}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                }).then(response => {
                        Swal.fire({
                            icon: 'success',
                            title: "Deleted!",
                            text: "Order has been deleted",
                        }).then(() => { 
                            location.reload(); 
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "Failed to delete the order. Please try again."
                        });
                    });
            }
        });
    }

    function updateStatus(event){
        const dropDown = event.target;
        const orderId = dropDown.getAttribute('data-order-id');
        const newStatus = dropDown.value;

        axios.patch(`${url}/${orderId}`,{
            status: newStatus
        }, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(response => {
            Swal.fire({
                icon:'success',
                title:'Status Updated',
                text: `Order status updated to ${newStatus}`,
                confirmButtonText: 'OK'
            });
        })
        .catch(error => {
                console.log(error);
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to update order status. Please try again.',
                confirmButtonText: 'OK',
            });
        });
    }


    function updateStatus(event) {
    const dropDown = event.target;
    const orderId = dropDown.getAttribute('data-box-id');
    const newStatus = parseInt(dropDown.value); // Convert the string value to an integer (0 or 1)

    axios.patch(`${url2}/${orderId}`, {
        status: newStatus
    }, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    }).then(response => {
        Swal.fire({
            icon: 'success',
            title: 'Status Updated',
            text: `Order status updated to ${newStatus === 1 ? 'Active' : 'Inactive'}`,
            confirmButtonText: 'OK'
        });
    })
    .catch(error => {
        console.log(error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to update order status. Please try again.',
            confirmButtonText: 'OK',
        });
    });
}
</script>
@endsection