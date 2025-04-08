@extends('layouts.master')
@section('content')
    <h1>service page</h1>
    <ul>
        <li>
            <a href="{{ route('service1')}}">service 1</a>
        </li>
        <li>
            <a href="{{ route('service2')}}">service 2</a>
        </li>
    </ul>
@endsection