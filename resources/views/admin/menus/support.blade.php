@extends('admin.layouts.admin')

@section('content')
    <div class="p-4">
        <x-form-header :value="__('Edit Support')" class="p-4" />

        @livewire('support-edit', [
            'about' => $about,
        ])

    </div>
@endsection
