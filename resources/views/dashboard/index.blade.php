@extends('layouts.app')
@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-md mx-auto  p-6 rounded-md shadow-md text-center">
        <h2 class="text-2xl font-bold mb-6">Welcome, {{ Auth::user()->name }}!</h2>
        
    </div>
</div>

@endsection
