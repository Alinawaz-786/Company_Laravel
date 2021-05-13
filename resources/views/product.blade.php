@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Script type</h2>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('js/Pages/custom.js') }}" defer></script>
@endsection
