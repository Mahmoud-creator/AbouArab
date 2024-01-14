<div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="modalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity opacity-0">
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div id="modalPanel" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-500 w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 sm:ml-4 sm:mt-0 sm:text-left w-full">


                                <div>
                                    <div class="px-4 sm:px-0">
                                        <h3 class="text-base font-semibold leading-7 text-gray-900">Order Information</h3>
                                        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Check <span id="order-id">#123</span> order information and details. <span id="order-date">Mar 8, 2021</span></p>
                                    </div>
                                    <div class="mt-6 border-t border-gray-100">
                                        <dl class="divide-y divide-gray-400">
                                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Customer name</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" id="customer-name"></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Customer email</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" id="customer-email"></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Customer phone</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" id="customer-phone"></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Order region</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" id="order-region"></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Customer address</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" id="customer-address"></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Order amount</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" id="order-amount"></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Note</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" id="order-note"></dd>
                                            </div>
                                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Order status</dt>
                                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0" id="order-status"></dd>
                                            </div>

                                            <div class="px-4 py-3 sm:px-0">
                                                <dt class="text-sm font-medium leading-6 text-gray-900">Order Items</dt>
                                                <div class="px-4 py-3 sm:px-0">
                                                    <table class="min-w-max w-full table-auto">
                                                        <thead>
                                                        <tr class="text-gray-600 uppercase text-sm leading-normal">
                                                            <th class="py-3 text-left">Image</th>
                                                            <th class="py-3 text-left">Name</th>
                                                            <th class="py-3 text-left">Addons</th>
                                                            <th class="py-3 text-left">Quantity</th>
                                                            <th class="py-3 text-left">Price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 text-sm font-light" id="items-body"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button id="cancel-button" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
