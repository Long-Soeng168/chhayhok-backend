@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Categories')" />
        @livewire('product_category-table-data')
    </div>
@endsection
