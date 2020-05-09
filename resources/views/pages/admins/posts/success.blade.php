@extends('layouts.admin')
@section('content')
    <h2>Success</h2>
<p>{{Auth::user()->name}}</p>
    
@endsection