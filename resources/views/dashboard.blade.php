@extends("skeleton")

@section('body')
    <p>This is dashboard and only be seen with verified user..</p>
    {{
        Auth::user()
    }}
@endsection