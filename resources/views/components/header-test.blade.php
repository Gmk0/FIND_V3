<div  class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
     role="dialog" @keydown.window.escape="showModal = false">
    <div class="absolute inset-0 transition-opacity duration-300 bg-slate-900/60" @click="showModal = false"
     x-transition:enter="ease-out" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"></div>
    <div class="relative max-w-3xl pt-10 pb-4 text-center transition-all duration-300 bg-white rounded-lg dark:bg-navy-700"
        x-transition:enter="easy-out"
        x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
        x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in"
        x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
        x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]">

      <!-- component -->
    <div class="py-6">
        <div class="flex max-w-3xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg lg:max-w-4xl">
            <div class="hidden bg-cover lg:block lg:w-1/2"
                style="background-image:url('https://images.unsplash.com/photo-1546514714-df0ccc50d7bf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=667&q=80')">
            </div>
            <div class="w-full lg:w-1/2">
                <h2 class="text-2xl font-semibold text-center text-gray-700">Brand</h2>
                <p class="text-xl text-center text-gray-600">Welcome back!</p>
                <a href="#" class="flex items-center justify-center mt-4 text-white rounded-lg shadow-md hover:bg-gray-100">
                    <div class="px-4 py-3">
                        <svg class="w-6 h-6" viewBox="0 0 40 40">
                            <path
                                d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z"
                                fill="#FFC107" />
                            <path
                                d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z"
                                fill="#FF3D00" />
                            <path
                                d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z"
                                fill="#4CAF50" />
                            <path
                                d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z"
                                fill="#1976D2" />
                        </svg>
                    </div>
                    <h1 class="w-5/6 px-4 py-3 font-bold text-center text-gray-600">Sign in with Google</h1>
                </a>
                <div class="flex items-center justify-between mt-4">
                    <span class="w-1/5 border-b lg:w-1/4"></span>
                    <a href="#" class="text-xs text-center text-gray-500 uppercase">or login with email</a>
                    <span class="w-1/5 border-b lg:w-1/4"></span>
                </div>
                <div class="mt-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700">Email Address</label>
                    <input
                        class="block w-full px-4 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded appearance-none focus:outline-none focus:shadow-outline"
                        type="email">
                </div>
                <div class="mt-4">
                    <div class="flex justify-between">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Password</label>
                        <a href="#" class="text-xs text-gray-500">Forget Password?</a>
                    </div>
                    <input
                        class="block w-full px-4 py-2 text-gray-700 bg-gray-200 border border-gray-300 rounded appearance-none focus:outline-none focus:shadow-outline"
                        type="password">
                </div>
                <div class="mt-8">
                    <button
                        class="w-full px-4 py-2 font-bold text-white bg-gray-700 rounded hover:bg-gray-600">Login</button>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <span class="w-1/5 border-b md:w-1/4"></span>
                    <a href="#" class="text-xs text-gray-500 uppercase">or sign up</a>
                    <span class="w-1/5 border-b md:w-1/4"></span>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
