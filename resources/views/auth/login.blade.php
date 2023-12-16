@extends('auth.auth-skeleton')

@section('form')
    <h2 class="text-slate-700 text-center text-2xl font-semibold mb-4">Login Here</h2>
    <form action="{{route('user-login')}}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="text-sm font-medium text-slate-700">Email Address</label>
            <input type="email"
                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:ring-1"
                name="email"
                id="email" placeholder="Enter your email">
        </div>

        <div class="mb-4">
            <label for="password" class="text-sm font-medium text-slate-700">Password</label>
            <input type="password"
                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:ring-1"
                id="password" name="password" placeholder="Enter your password">
        </div>

        <button type="submit"
            class="w-full items-center px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700">
            Log In Now !
        </button>
        <p class="text-center text-sm mt-4">
            Don't have an account?
            <a href="/register" class="text-indigo-500 hover:underline">Create One Here</a>
          </p>
    </form>
@endsection
