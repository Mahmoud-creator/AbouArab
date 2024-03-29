<div id="product-modal" class="relative hidden z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="product-modal-backdrop"
         class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity opacity-100"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex flex-col min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <button id="cancel-button" type="button"
                    class="mx-auto mb-2 mt-3 rounded-full bg-transparent text-xs p-2 font-bold text-gray-900 shadow-sm ring-2 ring-inset ring-gray-300 hover:ring-red-50 sm:mt-0 sm:w-auto">
                <x-icons.arrow-down class="w-6 h-6"/>
            </button>
            <div id="product-modal-panel"
                 class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                <div class="bg-white">
                    <div class="flex flex-col md:flex-row sm:items-start h-full product-modal-container">
                        <div class="product-modal-left-box flex-1 flex-grow h-full text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <input type="hidden" id="product-modal-id" data-product-id="">
                            <img class="object-center w-full object-cover"
                                 id="product-modal-image"
                                 src=""
                                 alt="product-image">
                            <div class="mx-auto relative flex items-center max-w-[8rem] -mt-5">
                                <button type="button" id="decrement-button"
                                        class="quantity-button bg-gray-50 hover:text-red-500 border border-r-0 border-dotted border-gray-300 rounded-s-full p-3 h-11 text-md">
                                    <x-icons.minus class="w-2 h-3 text-gray-900 hover:text-red-500"/>
                                </button>
                                <input type="text" id="quantity-input" aria-describedby="helper-text-explanation"
                                       class="bg-gray-50 border-dotted border-x-0 border-gray-300 h-11 text-center text-gray-900 text-lg focus:ring-0 block w-full py-2.5 user-select-none"
                                       disabled value="1" required>
                                <button type="button" id="increment-button"
                                        class="quantity-button bg-gray-50 hover:text-red-500 border border-l-0 border-dotted border-gray-300 rounded-e-full p-3 h-11 text-md">
                                    <x-icons.plus class="w-2 h-3 text-gray-900 hover:text-red-500"/>
                                </button>
                            </div>
                            <div class="text-center max-w-[18rem] mx-auto">
                                <h1 class="text-3xl font-bold text-red-500 mt-5" id="product-modal-name"></h1>
                                <p class="w-50 text-sm" id="product-modal-description"></p>
                                <p class="text-red-500 font-bold text-2xl mt-5" data-price=""
                                   id="product-modal-price"></p>
                            </div>
                        </div>
                        <div class="product-modal-right-box flex-1 flex-grow h-full mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left p-6 flex flex-col justify-between">
                            <div>
                                <h3 class="font-semibold uppercase text-gray-800 my-3 ">Complete Your
                                    Meal</h3>
                                <hr>
                                <div class="space-y-4 mt-4" id="product-modal-addons"></div>
                            </div>
                            <div>
                                <div class="w-full mt-8">
                                    <button id="confirm-button" type="button"
                                            class="w-full rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
