@extends('layouts.master')
@section('content')
<form id="cnt-form" action="{{ route('store')}}" method="POST">
  @csrf
  @if(session('status'))
  <div class="alert alert-success">{{session('status')}}</div>
  @endif
  <label for="name">Name:</label>
  <input type="text" id="name" name="name"  value="{{old('name')}}">
  @error('name') <span class="text-danger">{{$message}}</span>@enderror
  <br><br>
  <label for="enroll">Enrollment Number:</label>
  <input type="text" id="enroll" name="enroll"  value="{{old('enroll')}}">
  @error('enroll') <span class="text-danger">{{$message}}</span>@enderror
  <br><br>
  <label for="mob">Mobile Number:</label>
  <input type="number" id="mob" name="mob"  value="{{old('mob')}}">
  @error('mob') <span class="text-danger">{{$message}}</span>@enderror
  <br><br>
  <button type="submit">Submit</button> 
</form>
  <button style="margin:50px 300px"><a href="{{route('show')}}">Show Student</a></button>
  <button style="margin:50px 300px"><a href="{{route('insertByAjax')}}">Insert By AJAX</a></button>
@endsection