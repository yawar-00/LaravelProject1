@extends('layouts.master')
@section('content')
 <h1 class="hed">Show page</h1>
    @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
    @endif
     <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Enroll</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student as $item)
            <tr>
                <td >{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->enroll}}</td>
                <td>{{$item->mob}}</td>
                <td >
                    <a href="{{url('contact/'.$item->id.'/edit')}}" class="btn btn-success ">edit</a>
                    <a href="{{url('contact/'.$item->id.'/delete')}}" class="btn btn-danger ">delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
     </table>
@endsection