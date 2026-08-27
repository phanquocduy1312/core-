@extends('admin.layouts.app')

@section('title', 'Thêm khối dùng chung')

@section('content')
    <form method="POST" action="{{ route('admin.partials.store') }}" id="page-builder-form" class="space-y-6">
        @csrf
        @php($backRoute = route('admin.partials.index'))
        @include('admin.pages._form')
    </form>
@endsection
