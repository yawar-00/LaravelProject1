<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@extends('layouts.master')
@section('content')
<!-- @if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif -->

<h1 id="response"></h1>
<div class="card " style="width: 50rem;margin:0 25% !important">
    <div class="card-body text-end">
        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#ProductForm">
            Add Student
        </button>
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="tabledata">

        </tbody>
    </table>
</div>

<div class="modal fade" id="ProductForm" tabindex="-1" aria-labelledby="addModalLabel">
    <form id="addproductform">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf
                    <input name="id" id="id" type="hidden">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name">
                    <br><br>
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price">
                    <br><br>
                    <button type="submit" class="btn btn-secondary add_product" data-bs-dismiss="modal">Add
                        Product</button>
                </div>

            </div>
        </div>
    </form>
</div>


<script>
$(document).ready(function() {
    $('#addproductform').on('submit', function(e) {
        e.preventDefault();
        var data = $('#addproductform').serialize();
        $.ajax({
            url: "/contact.insertByAjax",
            type: "POST",
            data: {
                "_token": "{{csrf_token()}}",
                data: data
            },
            success: function(response) {
                clear();
                $('#response').html(response);
                $('#ProductForm').modal('hide');
                fetchrecords(); 
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            error: function(xhr) {
                let errorMsg = "Something went wrong!";
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).map(err => err[0]).join('\n');
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMsg
                });
            }
        });
    });
    $(document).on('click', '.editProduct', function(e) {
        e.preventDefault();
        var id = $(this).val();
        // alert(id)
        $.ajax({
            url: 'editproduct',
            type: 'POST',
            data: {
                "_token": "{{csrf_token()}}",
                id: id
            },
            success: function(resp) {
                $('#addproductform')[0].reset();
                $('#id').val(resp.id);
                $('#name').val(resp.name);
                $('#price').val(resp.price);
                $('#ProductForm').modal('show');
                // fetchrecords();
            }

        });
    })

    function clear() {
    $('#addproductform')[0].reset();
    $('#id').val('');
    }

    //delte
    $(document).on('click', '.deleteproduct', function(e) {
        e.preventDefault();
        var id = $(this).val();
        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'deleteProduct',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'The record has been deleted.',
                            'success'
                        );
                        fetchrecords();
                        $('#respanel').html(response);
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'Something went wrong while deleting.',
                            'error'
                        );
                    }
                });
            }
        });
    });


    function fetchrecords() {
        $.ajax({
            url: '/contact.showByAjax',
            type: 'GET',
            success: function(resp) {
                var tr = "";
                for (var i = 0; i < resp.length; i++) {
                    var id = resp[i].id;
                    var name = resp[i].name;
                    var price = resp[i].price;

                    tr += '<tr>';


                    tr += '<td>' + id + '</td>';
                    tr += '<td>' + name + '</td>';
                    tr += '<td>' + price + '</td>';
                    tr += '<td><button type="button" class="btn btn-warning editProduct" value="' +
                        id +
                        '">Edit</button></td>';
                    tr += '<td><button type="button" class="btn btn-danger deleteproduct" value="' +
                        id + '">Delete</button></td>';

                    tr += '</tr>';


                }
                $('#tabledata').html(tr);
            }
        });
    }
    fetchrecords();
});


//     if (confirm("Are you Sure to delete")) {
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             }
//         });
//         $.ajax({
//             url: 'deleteProduct/' + id,
//             type: 'DELETE',
//             status: function(result) {

//             }
//         })
//     }
// }
</script>


@endsection