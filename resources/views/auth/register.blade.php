@extends('auth.auth-skeleton')

@section('form')
  <h2 class="text-slate-700 text-center text-2xl font-semibold mb-4">Create Your Account</h2>

  <form method="POST" action="{{route('user-register')}}">
    @csrf
    <div class="grid grid-cols-2 gap-4">
      <div class="col">
        <label for="name" class="text-sm font-medium text-slate-700">Full Name</label>
        <input type="text" class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:ring-1" id="name" placeholder="John Doe" name="name">
      </div>

      <div class="col">
        <label for="email" class="text-sm font-medium text-slate-700">Email Address</label>
        <input type="email" class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:ring-1" id="email" name="email" placeholder="johndoe@xyz.com">
      </div>

      <div class="col">
        <label for="password" class="text-sm font-medium text-slate-700">Password</label>
        <input type="password" class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:ring-1" id="password" name="password" placeholder="********">
      </div>

      <div class="col">
        <label for="password_confirmation" class="text-sm font-medium text-slate-700">Confirm Password</label>
        <input type="password" class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:ring-1" id="password_confirmation" placeholder="********" name="password_confirmation">
      </div>
    </div>

    <button type="submit" class="w-full items-center px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700 mt-4">
      Register Now !
    </button>

    <p class="text-sm text-center text-slate-500 mt-4">Already have an account? <a href="/login" class="text-indigo-500">Log In Here</a></p>
  </form>
@endsection
