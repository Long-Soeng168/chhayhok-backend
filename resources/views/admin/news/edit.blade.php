@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Resource')" class="p-4" />

        @livewire('news-edit', [
            'id' => $id
        ])

    </div>
@endsection
