@extends('layouts.app')

@section('content')
    <x-breadcrumb />
    <div class="card">
        <div class="card-body">
            This is Home || {{ Auth::user()->isAuthor() ? "yes" : "no" }}
        </div>
    </div>
@endsection
