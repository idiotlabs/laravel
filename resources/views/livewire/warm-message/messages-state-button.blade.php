<div>
    @if ($message_state == 0)
        <button class="bg-white hover:bg-gray-100 py-2 px-4 border border-gray-400 rounded" wire:click="clickAccept">
            {{ $message_state_text }}
        </button>
    @elseif ($message_state == 1)
        <button class="bg-white hover:bg-gray-100 py-2 px-4 border border-gray-400 rounded" wire:click="clickStop">
            {{ $message_state_text }}
        </button>
    @else
        {{ $message_state_text }}
    @endif
</div>