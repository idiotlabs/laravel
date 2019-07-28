<div>
    @if ($message_state == 1)
        {{ $message_state_text }}
    @else
        <button class="bg-white hover:bg-gray-100 py-2 px-4 border border-gray-400 rounded" wire:click="clickStop">
            {{ $message_state_text }}
        </button>
    @endif
</div>