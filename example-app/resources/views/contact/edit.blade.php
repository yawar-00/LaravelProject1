@extends('layouts.master')
@section('content')
<form id="cnt-form" action="{{ url('contact/'.$student->id.'/edit')}}" method="POST">
  @csrf
  @method('PUT')
  @if(session('status'))
  <div class="alert alert-success">{{session('status')}}</div>
  @endif
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" value="{{$student->name}}">
  @error('name') <span class="text-danger">{{$message}}</span>@enderror
  <br><br>
  <label for="enroll">Enrollment Number:</label>
  <input type="text" id="enroll" name="enroll" value="{{$student->enroll}}">
  @error('enroll') <span class="text-danger">{{$message}}</span>@enderror
  <br><br>
  <label for="mob">Mobile Number:</label>
  <input type="number" id="mob" name="mob" value="{{$student->mob}}">
  @error('mob') <span class="text-danger">{{$message}}</span>@enderror
  <br><br>
  <button type="submit">Submit</button> 
</form>
  
@endsection