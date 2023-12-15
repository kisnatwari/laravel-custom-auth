@extends('skeleton')

@section('body')
<div class="text-slate-800 w-full min-h-screen flex justify-center items-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold">
            Welcome to the demo application
        </h1>
        <p class="text-xl mb-4">
            You are not logged in. Please login to continue.
        </p>
        
        <a href="/login" type="button" class="px-5 py-2 font-semibold rounded bg-indigo-600 text-gray-200">Login Now !</a>
        <a href="/register" class="px-8 py-3 font-semibold rounded bg-indigo-100 text-slate-800">Create an Account...</a>
    </div>
</div>
@endsection