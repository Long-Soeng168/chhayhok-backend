@extends('admin.layouts.admin')
@section('content')
    <div>
        <x-page-header :value="__('Resources')" />
        @livewire('news-table-data')
    </div>
@endsection
