@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Categories')" />
        @livewire('news-category-table-data')
    </div>
@endsection
