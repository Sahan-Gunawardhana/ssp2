@extends('layouts.sidebar')
@section('content')
<h2 class="px-2 text-4xl font-semibold text-gray-800 py-14">Manager Products</h2>
<div class="relative flex flex-col w-full h-full px-2 overflow-scroll text-white bg-white rounded-lg shadow-md bg-clip-border">
    <table class="w-full overflow-auto text-left rounded-lg" id="users-table">
        <thead class="text-lg bg-gray-800 rounded-t-lg">
            <tr class="text-lg text-left">
                <th class="p-4 border-b border-white bg-blue-gray-50">#</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Image</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Product Name</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Price</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Category</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Quantity</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Shelf Life</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Dimensions</th>
                <th class="p-4 border-b border-white bg-blue-gray-50">Actions</th>
            </tr>
        </thead>
        <tbody id="products-container">
            <tr class="even:bg-blue-gray-50/50">
                <td colspan="9" class="py-6 text-center text-white bg-teal-600">
                    Loading
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Button to Toggle Form -->
    <button id="toggleFormButton" class="px-6 py-3 mt-4 text-white bg-teal-600 rounded-md btn hover:bg-teal-700">
        Create New Product
    </button>

    <!-- Hidden Form (Initially Hidden) -->
    <div id="createProductFormContainer" style="display: none;" class="mt-6">
        <h2 class="mb-6 text-3xl font-semibold text-gray-800">Create Product</h2>
        <form id="createProductForm" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Product Name -->
            <div class="form-group">
                <label for="pro_name" class="text-lg font-medium text-gray-700">Product Name</label>
                <input type="text" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_name" name="pro_name" value="{{ old('pro_name') }}" required>
                <div id="error-pro_name" class="text-sm text-red-500"></div>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="pro_price" class="text-lg font-medium text-gray-700">Price</label>
                <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_price" name="pro_price" value="{{ old('pro_price') }}" required min="0">
                <div id="error-pro_price" class="text-sm text-red-500"></div>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category" class="text-lg font-medium text-gray-700">Category</label>
                <input type="text" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="category" name="category" value="{{ old('category') }}" required>
                <div id="error-category" class="text-sm text-red-500"></div>
            </div>

            <!-- Shelf Life -->
            <div class="form-group">
                <label for="shelf_life" class="text-lg font-medium text-gray-700">Shelf Life</label>
                <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="shelf_life" name="shelf_life" value="{{ old('shelf_life') }}" required min="0">
                <div id="error-shelf_life" class="text-sm text-red-500"></div>
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="pro_description" class="text-lg font-medium text-gray-700">Product Description</label>
                <textarea class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_description" name="pro_description" rows="4" required>{{ old('pro_description') }}</textarea>
                <div id="error-pro_description" class="text-sm text-red-500"></div>
            </div>

            <!-- Quantity -->
            <div class="form-group">
                <label for="quantity" class="text-lg font-medium text-gray-700">Quantity</label>
                <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required min="0">
                <div id="error-quantity" class="text-sm text-red-500"></div>
            </div>
            <!-- Width -->
            <div class="form-group">
                <label for="pro_width" class="text-lg font-medium text-gray-700">Width</label>
                <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_width" name="pro_width" value="{{ old('pro_width') }}" required min="0">
                <div id="error-pro_width" class="text-sm text-red-500"></div>
            </div>

            <!-- Height -->
            <div class="form-group">
                <label for="pro_height" class="text-lg font-medium text-gray-700">Height</label>
                <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_height" name="pro_height" value="{{ old('pro_height') }}" required min="0">
                <div id="error-pro_height" class="text-sm text-red-500"></div>
            </div>

            

            <!-- Length -->
            <div class="form-group">
                <label for="pro_length" class="text-lg font-medium text-gray-700">Length</label>
                <input type="number" class="w-full px-4 py-3 mt-2 text-black border rounded-md form-control" id="pro_length" name="pro_length" value="{{ old('pro_length') }}" required min="0">
                <div id="error-pro_length" class="text-sm text-red-500"></div>
            </div>

            <!-- Product Image -->
            <div class="form-group">
                <label for="image" class="block text-lg font-medium text-gray-700">Product Image</label>
                <input type="file" class="w-full mt-2 text-black border border-gray-300 rounded-md focus:outline-none" id="image" name="image">
                <div id="error-image" class="mt-1 text-sm text-red-500"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full px-6 py-3 text-white bg-teal-600 rounded-md btn hover:bg-teal-700">Create Product</button>
            <div class="h-50px">
                
            </div>
        </form>
    </div>
</div>

<script>


    document.addEventListener('DOMContentLoaded', function () {
        @if(session('updateSuccess'))
            Swal.fire({
                title: 'Success!',
                text: 'Product updated successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    });


    const url = 'http://127.0.0.1:8000/api/products';
    const token = localStorage.getItem('authToken');
    // Toggle form visibility
    document.getElementById('toggleFormButton').addEventListener('click', function() {
        var formContainer = document.getElementById('createProductFormContainer');
        if (formContainer.style.display === 'none' || formContainer.style.display === '') {
            formContainer.style.display = 'block';
        } else {
            formContainer.style.display = 'none';
        }
    });

        document.getElementById('createProductForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const proName = document.getElementById('pro_name').value;
        const proPrice = document.getElementById('pro_price').value;
        const category = document.getElementById('category').value;
        const shelfLife = document.getElementById('shelf_life').value;
        const quantity = document.getElementById('quantity').value;
        const proDescription = document.getElementById('pro_description').value;
        const proWidth = document.getElementById('pro_width').value;
        const proHeight = document.getElementById('pro_height').value;
        const proLength = document.getElementById('pro_length').value;
        const image = document.getElementById('image').files[0]; // Check if an image is selected

        if(proName && proPrice && category && shelfLife && proDescription && proWidth && proHeight && proLength){
            let formData = new FormData();
            formData.append('pro_name', proName);
            formData.append('pro_price', proPrice);
            formData.append('category', category);
            formData.append('shelf_life', shelfLife);
            formData.append('pro_description', proDescription);
            formData.append('pro_width', proWidth);
            formData.append('pro_height', proHeight);
            formData.append('quantity', quantity);
            formData.append('pro_length', proLength);

            // Only append the image if it's selected
            if (image) {
                formData.append('image', image);
            }

            
            axios.post(url, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': `Bearer ${token}`
                }
            })
            .then(response => {
                // SweetAlert on success
                Swal.fire({
                    title: 'Success!',
                    text: 'Product created successfully!',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    location.reload(); // Optional: reload page to show new product
                });
            })
            .catch(error => {
                console.error(error);
                if (error.response && error.response.data) {
                    console.log('Server response:', error.response.data);
                    // SweetAlert on error
                    Swal.fire({
                        title: 'Error!',
                        text: `Failed with error: ${error.response.data.message || 'Unknown error'}`,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        } else {
            // SweetAlert for missing fields
            Swal.fire({
                title: 'Oops!',
                text: 'All fields must be filled out.',
                icon: 'warning',
                confirmButtonText: 'Ok'
            });
        }   
    });


    document.addEventListener('DOMContentLoaded', function() {
    if (!token) {
        console.error("No authentication token found.");
        return;
    }

    axios.get(url, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
    .then(response => {
        const products = response.data.data; // Assuming response data is structured like {data: [...]}

        const productsContainer = document.getElementById('products-container');
        if (!productsContainer) {
            console.error("Products container not found.");
            return;
        }

        productsContainer.innerHTML = products.map((product, index) => `
            <tr class="bg-teal-600 border-b border-gray-200 hover:bg-teal-800">
                <td class="px-4 py-3 font-medium text-white border-r text-normal">${index + 1}</td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">
                    <img src="${product.pro_image_url}" alt="${product.pro_name}" class="object-cover w-16 h-16">
                </td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">${product.pro_name}</td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">${product.pro_price}</td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">${product.category}</td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">${product.quantity}</td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">${product.shelf_life}</td>
                <td class="px-4 py-3 font-medium text-white border-r text-normal">${product.pro_width} x ${product.pro_height} x ${product.pro_length}</td>
                <td class="flex items-center justify-center p-8 px-4 space-x-4">
                    <button onclick="deleteProduct('${product.id}')" class="text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed" stroke="#000" stroke-width="2">
                            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                        </svg>
                    </button>
                    <a href="products/${product.id}" class="text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffffffff"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </a>
                </td>
            </tr>
        `).join('');
        
    })
    .catch(error => {
        console.error(error);
    });
});

    
    function deleteProduct(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const authToken = localStorage.getItem('authToken'); // Get token from localStorage

                axios.delete(`${url}/${productId}`, {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    Swal.fire('Deleted!', 'Product has been deleted.', 'success')
                        .then(() => {
                            location.reload(); // Reload page after deletion
                        });
                })
                .catch(error => {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                });
            }
        });
    }

    
</script>
@endsection