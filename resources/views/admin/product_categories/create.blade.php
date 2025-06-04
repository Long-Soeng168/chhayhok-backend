@extends('admin.layouts.admin')

@section('content')
<div class="p-4">
    <x-form-header :value="__('Create Category')" class="p-4" />

    @livewire('product-category-create')

</div>
@endsection