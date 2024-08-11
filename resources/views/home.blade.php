@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md text-center">
        <h2 class="text-2xl font-bold mb-6">Welcome, {{ Auth::user()->name }}!</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Logout
            </button>
        </form>
    </div>
</div>
@endsection
