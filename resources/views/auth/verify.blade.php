@extends('auth.auth-skeleton')

@section('form')
    <h2 class="text-slate-700 text-center text-2xl font-semibold mb-4">Email Verification</h2>

    <form method="post" action="{{route('user-verify')}}">
        @csrf

        <p class="text-sm text-slate-500 mb-4">
            Please enter the verification code sent to your registered email address.
        </p>

        <div class="mb-4">
            <label for="verification_code" class="text-sm font-medium text-slate-700">Verification Code</label>
            <input type="text" name="verification_code" id="verification_code"
                class="block w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:ring-1">
        </div>

        <button type="submit"
            class="w-full items-center px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700">
            Verify Email
        </button>
    </form>
@endsection
