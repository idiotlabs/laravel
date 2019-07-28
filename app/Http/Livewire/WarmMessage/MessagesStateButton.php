<?php

namespace App\Http\Livewire\WarmMessage;

use Livewire\Component;

class MessagesStateButton extends Component
{
    public $message_state = 0;
    public $message_state_text = '대기';
    public $count = 0;

    public function mount($message_state)
    {
        $this->message_state = $message_state;

        $this->setStateText($this->message_state);
    }

    public function setStateText($message_state)
    {
        if ($message_state == 0) {
            $this->message_state_text = '대기';
        } elseif ($message_state == 1) {
            $this->message_state_text = '발송';
        } elseif ($message_state < 0) {
            $this->message_state_text = '홀드';
        }
    }

    public function clickStop()
    {
        if ($this->message_state < 0) {
            $this->message_state = 0;
        } else {
            $this->message_state = -1;
        }

        $this->setStateText($this->message_state);
    }

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.warm-message.messages-state-button');
    }
}
