<?php

namespace App\Http\Livewire\WarmMessage;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

/**
 * 메세지가 들어오면 관리자가 허락을 해야 메세지가 발송된다.
 *
 *
 * using livewire - https://github.com/livewire/livewire
 * ㄴ confirm 만들 수 없나...
 *
 * Class MessagesStateButton
 * @package App\Http\Livewire\WarmMessage
 */
class MessagesStateButton extends Component
{
    public $message_id;
    public $message_state;
    public $message_state_text;

    public function mount($message_id, $message_state)
    {
        $this->message_id = $message_id;
        $this->message_state = $message_state;

        $this->setStateText($this->message_state);
    }

    public function setStateText($message_state)
    {
        if ($message_state == 0) {
            $this->message_state_text = '컨펌중';
        } elseif ($message_state == 1) {
            $this->message_state_text = '발송 대기';
        } elseif ($message_state == 2) {
            $this->message_state_text = '발송 완료';
        }
    }

    public function clickAccept()
    {
        DB::table('wm_message')->where('id', $this->message_id)->update(['message_state' => 1]);

        $this->message_state = 1;

        $this->setStateText($this->message_state);
    }


    public function clickStop()
    {
        DB::table('wm_message')->where('id', $this->message_id)->update(['message_state' => 0]);

        $this->message_state = 0;

        $this->setStateText($this->message_state);
    }

    public function render()
    {
        return view('livewire.warm-message.messages-state-button');
    }
}
