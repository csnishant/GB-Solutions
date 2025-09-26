@extends('layouts.app')
@section('content')
<h1>Customer Home</h1>
<p>Welcome, {{ auth()->user()->name }}</p>
@endsection
