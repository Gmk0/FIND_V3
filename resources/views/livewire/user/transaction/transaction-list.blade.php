<div class="min-h-screen px-4 mx-auto max-w-7xl lg:px-8">


    <div class="max-w-3xl mb-8">
        <h2 class="mb-8 text-xl font-semibold tracking-wide uppercase text-amber-600">{{$title}}</h2>
    </div>

    <div>
        @include('include.bread-cumb-user',['transation'=>'transation', ])
    </div>






    <div x-show="loading" class="w-full bg-gray-100 rounded-md h-72 animate-pulse dark:bg-gray-800">

    </div>
  <div x-show="!loading"x-cloak class="my-4">
    {{$this->table}}

  </div>

</div>
