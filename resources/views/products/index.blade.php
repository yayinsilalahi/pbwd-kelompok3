<x-app-layout>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        @if(session()->has('success'))
            <x-alert message="{{ session('success') }}" />
        @endif

        <div class="flex items-center justify-between mt-6">
            <h2 class="text-xl font-semibold">List Products</h2>
            <a href="{{ route('products.create') }}">
                <button class="px-10 py-2 font-semibold bg-gray-300 rounded-md">Add</button>
            </a>
        </div>

        <div class="grid grid-cols-3 gap-6 mt-4">
            @foreach ($products as $product) 
                <div class="flex flex-col items-center p-4 overflow-hidden bg-white rounded-lg shadow-lg">
                    <!-- Gunakan asset() untuk memanggil gambar dari public/assets/images -->
                    <div class="flex items-center justify-center w-full">
                        <img src="{{ asset('assets/images/' . $product->foto) }}" alt="{{ $product->nama }}" class="object-contain max-w-full max-h-full" />
                    </div>

                    <div class="mt-4 text-center"> 
                        <h3 class="text-lg font-semibold">{{ $product->nama }}</h3>
                        <p class="mb-2 text-gray-600">Rp. {{ number_format($product->harga) }}</p>
                        <p class="text-gray-500">{{ $product->deskripsi }}</p>
                    </div>
                    <a href="{{ route('products.edit' , $product) }}">
                    <div class="w-full mt-4">
                        <button class="w-full px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                            Edit </button>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
