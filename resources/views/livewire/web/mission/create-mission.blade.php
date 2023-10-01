<div class="min-h-screen pt-16 border-t border-gray-100 bg-gray-50 dark:bg-gray-900">
    {{-- Success is as dangerous as failure. --}}

    <div class="mx-2">
            @include('include.bread-cumb',['mission'=>'Mission'])
        </div>
    <div x-data="project()" x-on:success.window="step = 1;show=false" class="container flex px-2 py-3 ">

        <div class="hidden w-6/12 p-4 lg:block">

            <img src="/images/hero/team.svg" class="object-cover w-full p-2 bg-white rounded-md h-11/12 " alt="">
        </div>

        <div x-show="loading" class="h-screen bg-gray-200 dark:bg-gray-800 lg:w-6/12 animate-pulse">

        </div>
        <div x-cloak x-show="!loading" class="flex flex-col w-full mx-auto lg:mx-0 lg:w-6/12 ">

            <form wire:submit.prevent='register'>
                {{$this->missionForm}}
            </form>



        </div>



    </div>





    <script>
        window.addEventListener('success', event=> {
     Swal.fire({
   // position: 'top-end',
    icon:'success',
    //toast: true,
    title:"operation reussie",
    text:event.detail.message,
    showConfirmButton: true,
    footer: '<a class="text-green-600" href="/user/list_projet">liste des proposition</a>',
    //timer:5000

    })

    });

    function  project(){
        return {
            step:1,
            show:false,
            setStep(){
            this.step=2,
            this.show=true,
            window.scrollTo({ top: 0, behavior: 'smooth' })
            },
            returnStep(){
            this.step=1,
            this.show=false,
            window.scrollTo({ top: 0, behavior: 'smooth' })
            },
        }
    }
    </script>


</div>
