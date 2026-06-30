<div
    x-show="show"
    x-cloak
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-9999"
>

    <div class="bg-white rounded-xl p-6 w-96 relative z-10000">

        <h2
            class="text-xl font-semibold mb-2"
            x-text="title"
        ></h2>

        <p
            class="text-black/60 mb-6"
            x-text="message"
        ></p>

        <div class="flex justify-end gap-2">

            <button
                @click="show = false"
                class="px-4 py-2 border rounded-lg cursor-pointer"
            >
                Batal
            </button>

            <button
                @click="submit"
                class="px-4 py-2 bg-ditolak text-white rounded-lg cursor-pointer"
            >
                Ya
            </button>

        </div>

    </div>

</div>