@extends('layouts.app')

@section('content')
@include('layouts.nav')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="dropdown-item" href="http://portal.test/logout" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"> Logout </a>
                    <form id="logout-form" action="http://portal.test/logout" method="POST" class="d-none">@csrf</form>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
