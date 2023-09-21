<div wire:loading wire:target='checkoutmaxi,pay,paid'>
    <div>
        <style>
            .loader-dots div {
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
            }

            .loader-dots div:nth-child(1) {
                left: 8px;
                animation: loader-dots1 0.6s infinite;
            }

            .loader-dots div:nth-child(2) {
                left: 8px;
                animation: loader-dots2 0.6s infinite;
            }

            .loader-dots div:nth-child(3) {
                left: 32px;
                animation: loader-dots2 0.6s infinite;
            }

            .loader-dots div:nth-child(4) {
                left: 56px;
                animation: loader-dots3 0.6s infinite;
            }

            @keyframes loader-dots1 {
                0% {
                    transform: scale(0);
                }

                100% {
                    transform: scale(1);
                }
            }

            @keyframes loader-dots3 {
                0% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(0);
                }
            }

            @keyframes loader-dots2 {
                0% {
                    transform: translate(0, 0);
                }

                100% {
                    transform: translate(24px, 0);
                }
            }
        </style>
        <div class="fixed top-0 left-0 z-50 flex items-center justify-center w-screen h-screen"
            style="background: rgba(0, 0, 0, 0.3);">
            <div class="flex flex-col items-center px-5 py-2 bg-white border rounded-lg">
                <div class="relative block w-20 h-5 mt-2 loader-dots">
                    <div class="absolute top-0 w-3 h-3 mt-1 bg-green-500 rounded-full"></div>
                    <div class="absolute top-0 w-3 h-3 mt-1 bg-green-500 rounded-full"></div>
                    <div class="absolute top-0 w-3 h-3 mt-1 bg-green-500 rounded-full"></div>
                    <div class="absolute top-0 w-3 h-3 mt-1 bg-green-500 rounded-full"></div>
                </div>
                <div class="mt-2 text-xs font-medium text-center text-gray-500">
                    Paiement en cours...
                </div>
            </div>
        </div>
    </div>
</div>