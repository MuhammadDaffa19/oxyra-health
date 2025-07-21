@if (session('status'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded shadow z-50"
    >
        {{ session('status') }}
        <button @click="show = false" class="ml-2 font-bold">&times;</button>
    </div>
@endif
