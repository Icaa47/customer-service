<div> @if ($showModal && $user)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"
                    wire:click="closeModal"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block p-6 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                        Request Koreksi Poin untuk: {{ $user->name }}
                    </h3>
                    <div class="mt-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                        <textarea wire:model="notes" id="notes" rows="3"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-navy-500 focus:border-navy-500 sm:text-sm"
                            placeholder="Misal: Poin kemarin salah hitung, seharusnya..."></textarea>
                    </div>

                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3">
                        <button wire:click="submitRequest" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-navy-700 border border-transparent rounded-md shadow-sm hover:bg-navy-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-navy-500 sm:col-start-2 sm:text-sm">
                            Kirim Request
                        </button>
                        <button wire:click="closeModal" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div> ```
