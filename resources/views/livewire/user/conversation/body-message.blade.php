<div x-data="{ isShowChatInfo: !$store.breakpoints.mdAndDown,showModal:false , usearActive: @entangle('usearActive'), activeChat: @entangle('selectedConversation'), messages: @entangle('messagesChat')}"
    x-effect="$store.breakpoints.mdAndDown === true && (isShowChatInfo = false)"
    class="flex flex-col w-full mt-0 messages main-content h-100vh chat-app" :class="isShowChatInfo && 'lg:mr-80'"
    @change-active-chat.window="activeChat=$event.detail">
    <div
        class="chat-header h-[61px] border-b border-slate-150 dark:border-navy-700 relative z-10 flex w-full shrink-0 items-center justify-between bg-white px-[calc(var(--margin-x)-.5rem)] shadow-sm transition-[padding,width] duration-[.25s] dark:bg-navy-800">
        <div class="flex items-center space-x-5">
            <div class="ml-1 h-7 w-7">
                <button
                    class="menu-toggle ml-0.5 flex h-7 w-7 flex-col justify-center space-y-1.5 text-primary outline-none focus:outline-none dark:text-accent-light/80"
                    :class="$store.global.isSidebarExpanded && 'active'"
                    @click="$store.global.isSidebarExpanded = !$store.global.isSidebarExpanded">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            <div @click="isShowChatInfo = true" x-show="activeChat?.name"
                class="flex items-center space-x-4 cursor-pointer font-inter">

                <template x-if="activeChat?.profile_path !== null">
                    <div class="avatar">
                        <img class="rounded-full" :src="'/storage/' + activeChat?.profile_path" alt="avatar" />
                    </div>
                </template>
                <template x-else>
                    <div class="avatar">
                        <img class="rounded-full" :src="activeChat?.profile_url" alt="avatar" />
                    </div>
                </template>

                <div>
                    <p class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100" x-text="activeChat?.name">
                    </p>
                    <p x-text="activeChat?.last_time" class="mt-0.5 text-xs"></p>
                </div>
            </div>
            <div @click="isShowChatInfo = true" x-show="!activeChat?.name"
                class="flex items-center space-x-4 cursor-pointer font-inter">
                <div>
                    <p class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                        Conversation
                    </p>

                </div>
            </div>
        </div>
        <div  wire:ignore class="flex items-center -mr-1">

            <button
                class="hidden p-0 rounded-full btn2 h-9 w-9 text-slate-500 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            <button @click="isShowChatInfo = !isShowChatInfo"
                :class="isShowChatInfo ? 'text-primary dark:text-accent-light' : 'text-slate-500 dark:text-navy-200'"
                class="p-0 rounded-full btn2 h-9 w-9 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.25 21.167h5.5c4.584 0 6.417-1.834 6.417-6.417v-5.5c0-4.583-1.834-6.417-6.417-6.417h-5.5c-4.583 0-6.417 1.834-6.417 6.417v5.5c0 4.583 1.834 6.417 6.417 6.417ZM13.834 2.833v18.334" />
                </svg>
            </button>
            <div x-show="activeChat?.name">
                <div x-data="usePopper({ placement: 'bottom-end', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
                    class="inline-flex">
                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                        class="p-0 rounded-full btn2 h-9 w-9 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>

                    <div x-cloak x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                        <div
                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                            <ul>


                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 space-x-3 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-px" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        <span>Block User</span></a>
                                </li>
                                <li>
                                    <a href="#" wire:click="$toggle('confirmModal')"
                                        class="flex items-center h-8 px-3 pr-8 space-x-3 font-medium tracking-wide transition-all outline-none text-error hover:bg-error/20 focus:bg-error/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span> Delete chat</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div :class="$store.breakpoints.smAndUp && 'scrollbar-sm'"
        class="grow overflow-y-auto main-messages px-[calc(var(--margin-x)-.5rem)] py-5 transition-all duration-[.25s]">


        <div x-show="messages !== null" x-transition:enter="transition-all duration-500 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" class="space-y-5">

            <div class="flex items-center mx-4 space-x-3">
                <div class="flex-1 h-px bg-slate-200 dark:bg-navy-500"></div>
                <p>Pour plus de sécurité et votre protection, effectuez les paiements et les communications directement
                    sur FIND.</p>
                <div class="flex-1 h-px bg-slate-200 dark:bg-navy-500"></div>
            </div>
            @empty(!$messagesChat)
            @php
            $currentDate = null;
            @endphp
            @forelse ($messagesChat as $message)
            <!-- Boucle sur les messages -->
            @if ($message->created_at->toDateString() !== $currentDate)



            <div class="flex items-center mx-4 space-x-3">
                <div class="flex-1 h-px bg-slate-200 dark:bg-navy-500"></div>
                <p>{{ $message->created_at->format('l') }}</p>
                <div class="flex-1 h-px bg-slate-200 dark:bg-navy-500"></div>
            </div>
            @php
            $currentDate = $message->created_at->toDateString();
            @endphp
            @endif


            <div
                class="flex items-start {{auth()->id() == $message->sender_id ? 'justify-end':''}} space-x-2.5 sm:space-x-5">
                <div class="avatar {{auth()->id() == $message->sender_id ? 'hidden':''}} ">
                    @component('components.user-photo',['user'=>$message->senderUser])

                    @endcomponent

                </div>

                <div class="flex flex-col items-start space-y-3.5">
                    <div class="max-w-lg {{ auth()->id() == $message->sender_id ? 'ml-4 md:ml-10' : 'mr-4 sm:mr-10' }}">
                        @if(!empty($message->body))


                        <div
                            class="p-3 break-normal {{ auth()->id() == $message->sender_id ? 'rounded-br-none bg-info/10 p-3 text-slate-700  dark:bg-accent dark:text-white' : 'rounded-bl-none dark:bg-navy-700 bg-navy-100 dark:text-navy-100' }} shadow-sm rounded-2xl">
                            <p class="max-w-full overflow-x-hidden">{{ $message->body }}</p>
                        </div>

                        @if ($message->service_id !== null)
                        <!-- Afficher un petit texte indiquant que le message est lié à un service -->
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Ce message est lié à un service :</p>

                        <!-- Afficher le bloc du service lié -->
                        <div
                            class="flex items-center p-3 bg-gray-200 rounded-lg shadow-sm dark:bg-navy-700 dark:text-navy-100">
                            <img class="w-10 h-10 mr-2 rounded-lg"
                                src="{{ Storage::disk('local')->url($message->service->files[0]) }}"
                                alt="Service Image">
                            <a href="{{ route('ServicesViewOne', ['service_numero' => $message->service->service_numero, 'category' => $message->service->category->name]) }}"
                                class="truncate hover:text-amber-500 ">{{ $message->service->title }}</a>
                        </div>
                        @endif
                        @endif

                        @if(!empty($message->file))

                        @if($message->type=="file")
                        @php
                        $fileCount = count($message->file);
                        @endphp

                        @if ($fileCount === 1 && in_array(pathinfo($message->file[0])['extension'], ['jpg', 'jpeg',
                        'png', 'gif'], true))
                        <div class="relative group">
                            <img class="object-cover rounded-lg h-44"
                                src="{{ Storage::disk('local')->url($message->file[0]) }}" alt="image" />

                            <div
                                class="absolute top-0 flex items-center justify-center w-full h-full transition-all duration-300 rounded-lg opacity-0 bg-black/30 group-hover:opacity-100">
                                <button
                                    class="p-0 font-medium text-white rounded-full btn2 h-9 w-9 bg-info hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="grid grid-cols-12 gap-2">
                            @foreach ($message->file as $key => $value)
                            <div class="relative col-span-{{ count($message->file) === 3 ? '4' : '6' }} group">
                                <div class="relative group">
                                    <img class="object-cover h-48 rounded-lg"
                                        src="{{ Storage::disk('local')->url($value) }}" alt="image" />

                                    <div
                                        class="absolute top-0 flex items-center justify-center w-full h-full transition-all duration-300 rounded-lg opacity-0 bg-black/30 group-hover:opacity-100">
                                        <a href="{{ Storage::disk('local')->url($message->file[0]) }}" download
                                            class="p-0 font-medium text-white rounded-full btn2 h-9 w-9 bg-info hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif


                        @else
                        <div class="relative group">

                            @php
                            $filePath = $message->file[0]; // Remplacez ceci par le chemin réel de votre fichier
                            $fileName = substr($filePath, strrpos($filePath, '/') + 1);
                            @endphp
                            <div
                                class="p-3 bg-white break-normal {{ auth()->id() == $message->sender_id ? 'rounded-br-none bg-info/10 p-3 text-slate-700  dark:bg-accent dark:text-white' : 'rounded-bl-none dark:bg-navy-700 dark:text-navy-100' }} shadow-sm rounded-2xl">
                                <a href="{{ Storage::disk('local')->url($message->file[0]) }}" download class="">
                                    {{$fileName}}

                                </a>



                            </div>

                            <div
                                class="absolute top-0 flex items-center justify-center w-full h-full transition-all duration-300 rounded-lg opacity-0 bg-black/30 group-hover:opacity-100">
                                <a href="{{ Storage::disk('local')->url($message->file[0]) }}" download
                                    class="p-0 font-medium text-white rounded-full btn2 h-9 w-9 bg-info hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>
                            </div>
                        </div>



                        @endif
                        @endif


                        <p class="mt-1 ml-auto text-xs text-right text-slate-400 dark:text-navy-300">
                            {{ $message->created_at->format('m: i a')
                            }}
                        </p>
                    </div>
                </div>


            </div>


            @empty

            @endforelse

            @endempty





        </div>

        <div x-show="messages === null" x-transition:leave="transition-all duration-500 easy-in">
            <div class="flex flex-col items-center justify-center mt-8">


                <div class="flex flex-col items-center mx-4 space-x-3">

                    <p class="text-lg">Pour plus de sécurité et votre protection, effectuez les paiements et les
                        communications
                        directement
                        sur FIND.</p>


                    <div class="w-4/12 py-8">
                        <img src="/images/illustrations/chat-ui.svg" alt="illustation">

                    </div>

                </div>



            </div>

        </div>



    </div>


    <div x-show="activeChat?.name"
        class="chat-footer relative flex h-12 w-full shrink-0 items-center justify-between border-t border-slate-150 bg-white px-[calc(var(--margin-x)-.25rem)] transition-[padding,width] duration-[.25s] dark:border-navy-600 dark:bg-navy-800">
        <div class="-ml-1.5 flex flex-1 space-x-2">
            <button @click="showModal = true"
                class="p-0 rounded-full btn2 h-9 w-9 shrink-0 text-slate-500 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </button>


            <input type="text" wire:model="body"
                class="w-full h-10 bg-transparent border-none focus:ring-0 placeholder:text-slate-400/70"
                placeholder="Write the message" />
        </div>

        <div class="-mr-1.5 flex">
            <button
                class="p-0 rounded-full btn2 h-9 w-9 shrink-0 text-slate-500 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>




            <button wire:click="sendMessage()"
                class="p-0 rounded-full btn2 h-9 w-9 shrink-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.813 5.146 9.027 3.99c4.05 1.79 4.05 4.718 0 6.508l-9.027 3.99c-6.074 2.686-8.553.485-5.515-4.876l.917-1.613c.232-.41.232-1.09 0-1.5l-.917-1.623C1.26 4.66 3.749 2.46 9.813 5.146ZM6.094 12.389h7.341" />
                </svg>
            </button>





        </div>
    </div>





    <div wire:ignore x-data="{activeTab:'tabHome'}" x-on:close.window="showModal=false"
        class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
        x-show="showModal" role="dialog">
        <div class="absolute inset-0 transition-opacity duration-300 bg-slate-900/60" x-show="showModal"
            x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>
        <div class="relative pt-10 pb-8 text-center transition-all duration-300 bg-white rounded-lg max-w-md lg:w-[30rem] dark:bg-navy-700"
            x-show="showModal" x-transition:enter="easy-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in"
            x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
            x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]">

            <!-- Le contenu de ton modal -->

            <div>


                <div
                    class="mx-1 overflow-x-auto rounded-lg is-scrollbar-hidden bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                    <div class="tabs-list flex px-1.5 py-1">

                        <button @click="activeTab = 'tabHome'"
                            :class="activeTab === 'tabHome' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                            class="btn2 shrink-0 px-3 py-1.5 font-medium">
                            Image
                        </button>
                        <button @click="activeTab = 'doc'"
                            :class="activeTab === 'doc' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                            class="btn2 shrink-0 px-3 py-1.5 font-medium">
                            Document
                        </button>

                    </div>
                </div>


                <div class="p-2" x-show="activeTab === 'tabHome'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">


                    {{$this->imageForm}}


                </div>
                <div class="p-2" x-show="activeTab === 'doc'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">


                    {{$this->fileForm}}

                </div>



            </div>





            <div class="h-px my-4 mt-8 bg-slate-200 dark:bg-navy-500"></div>

            <div class="flex justify-around px-8 space-x-3">
                <button @click="showModal = false" wire:click="resetFile()"
                    class="btn2 min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                    Annuler
                </button>
                <div x-show="activeTab === 'tabHome'">

                    <button wire:click="SendMessageFile()" wire:loading.attr='disabled'
                        class="btn2 min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                        <span wire:loading wire:target='file'>Chargement</span>
                        <span wire:loading.remove wire:target='file'>Envoyer l'image</span>
                        <span wire:loading wire:target='SendMessageFile'>Envoi...</span>
                    </button>

                </div>
                <div x-show="activeTab === 'doc'">

                    <button wire:click="SendMessageDoc()" wire:loading.attr='disabled'
                        class="btn2 min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                        <span wire:loading wire:target='file'>Chargement</span>
                        <span wire:loading.remove wire:target='file'>Envoyer un DOC</span>
                    </button>

                </div>

            </div>
        </div>
    </div>




    <div x-data="{
                    get showDrawer() { return $data.isShowChatInfo; },
                    set showDrawer(val) { $data.isShowChatInfo = val; },
                }" x-show="showDrawer" @keydown.window.escape="showDrawer = false">
        <div class="fixed inset-0 z-[100] bg-slate-900/60 transition-opacity duration-200" @click="showDrawer = false"
            x-show="showDrawer && $store.breakpoints.mdAndDown" x-transition:enter="ease-out"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>
        <div class="fixed right-0 top-0 z-[101] h-full w-full  sm:w-80">
            <div class="relative flex flex-col w-full h-full overflow-auto transition-transform duration-200 bg-white border-l scrollbar-sm custom-scrollbar border-slate-150 dark:border-navy-600 dark:bg-navy-750"
                x-show="showDrawer" x-transition:enter="ease-out transform-gpu"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="ease-in transform-gpu" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">







                <div class="flex min-h-[60px] items-center justify-between  p-4">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        Chat Info
                    </h3>
                    <div class="-mr-1.5 flex space-x-1">
                        <button @click="$store.global.isRightSidebarExpanded = true"
                            class="w-8 h-8 p-0 rounded-full btn2 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5.5 w-5.5 text-slate-500 dark:text-navy-100" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </button>

                        <button @click="$store.global.isDarkModeEnabled = !$store.global.isDarkModeEnabled"
                            class="w-8 h-8 p-0 rounded-full btn2 hover:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg x-show="$store.global.isDarkModeEnabled"
                                x-transition:enter="transition-transform duration-200 ease-out absolute origin-top"
                                x-transition:enter-start="scale-75" x-transition:enter-end="scale-100 static"
                                class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M11.75 3.412a.818.818 0 01-.07.917 6.332 6.332 0 00-1.4 3.971c0 3.564 2.98 6.494 6.706 6.494a6.86 6.86 0 002.856-.617.818.818 0 011.1 1.047C19.593 18.614 16.218 21 12.283 21 7.18 21 3 16.973 3 11.956c0-4.563 3.46-8.31 7.925-8.948a.818.818 0 01.826.404z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" x-show="!$store.global.isDarkModeEnabled"
                                x-transition:enter="transition-transform duration-200 ease-out absolute origin-top"
                                x-transition:enter-start="scale-75" x-transition:enter-end="scale-100 static"
                                class="w-6 h-6 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <button @click="showDrawer=false"
                            class="w-8 h-8 p-0 rounded-full btn2 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                @empty(!$receiverInstance)
                <div wire:loading.remove wire:target='changeChatuSER' class="flex flex-col items-center my-5">
                    <div x-show="activeChat" class="w-20 h-20 avatar ">


                        <template x-if="activeChat?.profile_path !== null">

                            <img class="rounded-full" :src="'/storage/' + activeChat?.profile_path" alt="avatar" />

                        </template>
                        <template x-else>

                            <img class="rounded-full" :src="activeChat?.avatar_url" alt="avatar" />

                        </template>

                    </div>
                    <h3 x-text="activeChat?.name" class="mt-2 text-lg font-medium text-slate-700 dark:text-navy-100">
                    </h3>
                    <p>{{$receiverInstance?->freelance?->category->name}}</p>
                    <div class="mt-2 flex space-x-1.5">

                        <button
                            class="w-10 h-10 p-0 rounded-full btn2 text-slate-600 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div wire:loading.remove wire:target='changeChatuSER' x-data="{ activeTab: 'tabImages' }"
                    class="flex flex-col mt-6">
                    <div class="px-4 mb-8 overflow-hidden overflow-x-auto is-scrollbar-hidden">
                        <div class="flex tabs-list">
                            <button @click="activeTab = 'services'"
                                :class="activeTab === 'services' ?
                                                                            'border-primary dark:border-accent text-primary dark:text-accent-light' :
                                                                            'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                class="px-3 py-2 font-medium border-b-2 rounded-none btn2 shrink-0">
                                services
                            </button>
                            <button @click="activeTab = 'tabImages'"
                                :class="activeTab === 'tabImages' ?
                                                'border-primary dark:border-accent text-primary dark:text-accent-light' :
                                                'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                class="px-3 py-2 font-medium border-b-2 rounded-none btn2 shrink-0">
                                Images
                            </button>
                            <button @click="activeTab = 'tabFiles'"
                                :class="activeTab === 'tabFiles' ?
                                                'border-primary dark:border-accent text-primary dark:text-accent-light' :
                                                'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                class="px-3 py-2 font-medium border-b-2 rounded-none btn2 shrink-0">
                                Files
                            </button>
                        </div>
                    </div>
                    <div class="px-4 pt-4 overflow-auto">
                        <div x-show="activeTab === 'tabImages'"
                            x-transition:enter="transition-all duration-500 easy-in-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                            <div class="grid grid-cols-4 gap-2">


                                @empty(!$messageElement)

                                @foreach ($messageElement as $message)



                                @empty(!$message->file)
                                @foreach ($message->file as $key => $value)
                                @if (in_array(pathinfo($value)['extension'], ['jpg','JPG', 'jpeg', 'png', 'gif'], true))
                                <img class="object-cover object-center rounded-lg aspect-square"
                                    src="{{ Storage::disk('local')->url($value) }}" alt="image" />
                                @endif
                                @endforeach
                                @endempty
                                @endforeach
                                @endempty

                            </div>
                        </div>
                        <div x-show="activeTab === 'tabFiles'"
                            x-transition:enter="transition-all duration-500 easy-in-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                            <div class="flex flex-col space-y-3.5">

                                @empty(!$messagesChat)

                                @foreach ($messagesChat as $message)



                                @if(!empty($message->file) && $message->type=="doc")
                                @foreach ($message->file as $key => $value)

                                @php
                                $filePath = $message->file[0]; // Remplacez ceci par le chemin réel de votre fichier
                                $fileName = substr($filePath, strrpos($filePath, '/') + 1);
                                $fullFilePath = Storage::disk('local')->path('public/'.$filePath);

                                // Obtenez la taille du fichier en utilisant la fonction PHP filesize()
                                $fileSizeBytes = filesize($fullFilePath);

                                // Convertissez la taille en une unité lisible par l'homme (ko, Mo, Go, etc.)
                                $fileSizeReadable = \Illuminate\Support\Facades\File::size($fullFilePath);
                                $fileSizeMB = round($fileSizeReadable / 1024 , 2);
                                @endphp
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="flex items-center justify-center text-white mask is-squircle h-11 w-11 bg-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-700 dark:text-navy-100">
                                            {{$fileName}}
                                        </p>
                                        <div class="flex text-xs text-slate-400 dark:text-navy-300">
                                            <span>{{$fileSizeMB}} Ko</span>
                                        </div>
                                    </div>
                                </div>




                                @endforeach
                                @endif
                                @endforeach
                                @endempty





                            </div>
                        </div>
                        <div x-show="activeTab === 'services'"
                            x-transition:enter="transition-all    duration-500 easy-in-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">

                            <div class="grid grid-cols-1 gap-2 pb-4 overflow-hidden ">

                                @empty(!$services)

                                @forelse ($services as $service)
                                <div class="flex flex-row bg-gray-200 dark:bg-navy-700 h-28">
                                    <img class="object-cover object-center bg-center bg-cover rounded-t-lg w-28 h-28 shrink-0 lg:rounded-l-lg lg:rounded-t-none"
                                        src="{{ Storage::disk('local')->url($service->files[0]) }}" alt="image" />

                                    <div class="flex flex-col w-full px-4 py-3 sm:px-5">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h1>{{$service->basic_price}}$</h1>
                                            </div>

                                            <div class="-mr-1.5 flex space-x-1">
                                                <button
                                                    class="p-0 rounded-full btn2 h-7 w-7 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                                    </svg>
                                                </button>

                                                <div x-data="usePopper({placement:'bottom-end',offset:4})"
                                                    @click.outside="isShowPopper && (isShowPopper = false)"
                                                    class="inline-flex">
                                                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                                                        class="p-0 rounded-full btn2 h-7 w-7 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                        </svg>
                                                    </button>

                                                    <div x-ref="popperRoot" x-show="isShowPopper" x-cloak
                                                        class="popper-root" :class="isShowPopper && 'show'">
                                                        <div
                                                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                                            <ul>
                                                                <li>
                                                                    <a href="#"
                                                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Action</a>
                                                                </li>

                                                            </ul>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{route('ServicesViewOne',['service_numero'=>$service->service_numero,'category'=>$service->category->name])}}"
                                                class="text-sm font-medium line-clamp-1 text-slate-700 hover:text-amber-600 focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                                                {{$service->title}}</a>
                                        </div>
                                    </div>
                                </div>

                                @empty
                                <div>
                                    <h1 class="text-gray-800">Aucun service pour ce freelance</h1>
                                </div>

                                @endforelse

                                @endempty





                            </div>


                        </div>
                    </div>
                </div>

                @else


                <div class="flex flex-col items-center mt-5">
                    <div class="w-20 h-20 avatar ">

                        @if (!empty(Auth::user()->profile_photo_path))
                        <img class="object-cover rounded-full"
                            src="{{Storage::disk('local')->url(Auth::user()->profile_photo_path) }}" alt="">
                        @else
                        <img class="rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="">
                        @endif




                    </div>
                    <h3 class="mt-2 text-lg font-medium text-slate-700 dark:text-navy-100">{{Auth::user()->name}}
                    </h3>
                    <p>{{Auth::user()->freelance?->category->name}}</p>
                    <div class="mt-2 flex space-x-1.5">

                        <button
                            class="w-10 h-10 p-0 rounded-full btn2 text-slate-600 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-4 mt-6">
                    <div class="text-base font-medium text-slate-700 dark:text-navy-100">
                        Choisissez un utilisateur pour Converser
                    </div>

                </div>

                @endempty


            </div>
        </div>
    </div>


    <x-confirmation-modal wire:model.defer="confirmModal">

        <x-slot name="title">
            Annuler la commande

        </x-slot>

        <x-slot name="content">
            Voulez-vous supprimer cette conversation?

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmModal')" wire:loading.attr="disabled">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="EffacerMessage()" wire:loading.attr="disabled">
                {{ __('Effacer') }}
            </x-danger-button>
        </x-slot>

    </x-confirmation-modal>




















    <script>
        var messages = document.querySelector(".main-messages");

        messages.addEventListener("scroll", function() {

        var top = messages.scrollTop;

        if (top == 0) {

        @this.dispatch("loadmore");
        }
        });

        window.addEventListener('rowChatToBottom', event => {
            const messagesContainer = $('.main-messages');
            const scrollHeight = messagesContainer[0].scrollHeight;
            // Faire défiler vers le bas avec une animation
            messagesContainer.animate({ scrollTop: scrollHeight }, 500); // La durée de l'animation en millisecondes
            });

        window.addEventListener('updatedHeight', event => {
                let old = event.detail.height;
                let newHeight = $('.main-messages')[0].scrollHeight;
                let height = $('.main-messages').scrollTop(newHeight - old);
               @this.dispatch('updateHeight', {
                height: height,
                });
        });
    </script>



</div>
