@extends('_layout.master')

@section('content')
    <div>
        @livewire('warm-message.messages', $messages)
    </div>
@endsection

@section('js')
    @livewireAssets
@endsection