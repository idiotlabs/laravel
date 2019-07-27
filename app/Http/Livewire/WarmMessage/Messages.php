<?php

namespace App\Http\Livewire\WarmMessage;

use Livewire\Component;

class Messages extends Component
{
    public $messages;

    public function mount($messages)
    {
        $this->messages = $messages;
    }

    public function render()
    {
        return view('livewire.warm-message.messages', ['messages' => $this->messages]);
    }
}
