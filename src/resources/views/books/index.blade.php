@extends('layouts.master')
@section('title','Home Page')
@section('content')
    <div class='container p-4'>
        <div class="py-5 text-center">
            <div class='row'>
                <div class='col-md-12'>
                    <h1>My Books</h1>
                </div>
            </div>
        </div>
    </div>
    <div class='container bg-white p-4 mb-4'>
        @include('books.add-form')
    </div>
    <div class='container bg-white p-4'>
        @include('books.list')
    </div>
    <!-- Error -->
    @if(Session::has('error'))
        <div class='container bg-white p-4'>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error.</strong>
                <span>{{ Session::get('error', '') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
@endsection
