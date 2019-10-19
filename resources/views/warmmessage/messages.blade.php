@extends('warmmessage._layout.master')

@section('content')
{{--    <div>--}}
{{--        @livewire('warm-message.messages', $messages)--}}
{{--    </div>--}}
<table class="table-responsive table-hover">
    <tr>
        <th class="w-4/6 py-4 border-b border-grey-light text-center">message</th>
        <th class="w-1/6 py-4 border-b border-grey-light text-center">date</th>
        <th class="w-1/6 py-4 border-b border-grey-light text-center">state</th>
    </tr>
    @foreach ($messages as $message)
        <tr>
            <td class="pl-4 py-4 border-b border-grey-light">{{$message->message}}</td>
            <td class="py-4 border-b border-grey-light text-center">{{$message->created_at}}</td>
            <td class="py-4 border-b border-grey-light text-center">@livewire('warm-message.messages-state-button', $message->id, $message->message_state)</td>
        </tr>
    @endforeach
</table>
@endsection