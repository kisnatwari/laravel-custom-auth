@extends('skeleton')

@section('body')
    <div class="text-slate-800 w-full min-h-screen flex justify-center items-center bg-indigo-50">
        <div class="rounded-lg bg-white shadow-lg max-w-md p-8 border-t-2 border-indigo-500">
            @yield('form')
            @if ($errors->any())
                <ul class="text-red-500 text-sm font-semibold mb-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
@endsection
