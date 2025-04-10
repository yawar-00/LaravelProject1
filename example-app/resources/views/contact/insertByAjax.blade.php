@extends('layouts.master')
@section('content')
@if(session('status'))
<div class="alert alert-success">{{session('status')}}</div>
@endif

<div class="card " style="width: 50rem;margin:0 25% !important">
    <div class="card-body text-end">
        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
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
        <tbody>
            @foreach($product as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->price}}</td>
                <td>
                    <a href="{{url('contact/' . $item->id . '/editProduct')}}" class="btn btn-success ">edit</a>
                    <a onclick="deleteProduct($item->id)" class="btn btn-danger ">delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="addModalLabel">
    <form id="addproductform" action="{{ route('storeproduct') }}" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @csrf

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name">
                    <!-- @error('name') <span class="text-danger">{{$message}}</span>@enderror -->
                    <br><br>
                    <label for="enroll">Price:</label>
                    <input type="text" id="price" name="price">
                    <!-- @error('price') <span class="text-danger">{{$message}}</span>@enderror -->
                    <br><br>
                    <button type="submit" class="btn btn-secondary add_product" data-bs-dismiss="modal">Add
                        Product</button>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>

        </div>
    </form>
</div>


<script>
function deleteProduct(e) {
    // console.log(id);
    e.preventDefault();
    // var url = e.currentTarget.getAttribute('href')x
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });
        }
    });

    // if (confirm("Are you Sure to delete")) {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: 'deleteProduct/' + id,
    //         type: 'DELETE',
    //         status: function(result) {

    //         }
    //     })
    // }
}
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

@endsection