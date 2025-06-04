@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Category')" class="p-4" />

        @livewire('product-category-edit', [
            'item' => $item,
        ])

    </div>
@endsection
