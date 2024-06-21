<x-app-layout>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mt-6">
            <h2 class="text-xl font-semibold">List Products</h2>
            <button class="px-10 py-2 font-semibold bg-gray-300 rounded-md">Tambah</button>
        </div>

        <div class="grid grid-cols-3 gap-6 mt-4">
            @foreach ($products as $product)
                <div>
                    <img src="{{ url('storage/' . $product->foto)}}" />
                    <div class="my-2">
                        <p class="text-xl font-light">{{ $product->nama }}</p>
                        <p class="font-semibold text-gray-400">Rp. {{ number_format ($product->harga) }}</p>
                    </div>
                    <div>
                        <button class="w-full px-10 py-2 font-semibold bg-gray-300 rounded-md">Edit</button>
                    </div>
                </div> 
                
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>

    </div>
</x-app-layout>
