<?php

namespace App\Livewire\User\Conversation;

use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Contracts\Pagination\Paginator;

#[Layout('layouts.chat-layout')]
#[Title('User converstaion')]


class ComponentChatUser extends Component
{
    public function render()
    {
        return view('livewire.user.conversation.component-chat-user');
    }
}
