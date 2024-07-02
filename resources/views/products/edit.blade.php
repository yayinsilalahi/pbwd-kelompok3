<x-app-layout>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between mt-6 text-xl font-semibold">
            <h2 class="items-center">Edit Products</h2>
            @include('products.partials.delete-product')
        </div> 

        <div class="mt-4" x-data="{ imageUrl: '/storage/{{ $product->foto }}' }">
            <form enctype="multipart/form-data" method="POST" action="{{ route('products.update', $product)}}" class="flex gap-8">
                @csrf
                @method('PUT')

                <div class="w-1/2">
                    <img :src="imageUrl" class="rounded-md" />
                </div>
                <div class="w-1/2"> 
                    <div class="mt-4">
                        <x-input-label for="foto" :value="__('foto')" />
                        <x-text-input accept="image/*"
                        id="foto" 
                        class="block w-full p-2 mt-1 border" 
                        type="file" 
                        name="foto" 
                        :value="old('foto')" 
                        @change="imageUrl = URL.createObjectURL ( $event.target.files[0])"
                        />                      
                        <x-input-error :messages="$errors->get($product->foto)" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block w-full mt-1" type="text" name="nama" :value="old('nama')" required  />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="harga" :value="__('Harga')" />
                        <x-text-input id="harga" class="block w-full mt-1" type="text" name="harga" :value="old('harga')" required  />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="deskripsi" :value="__('deskripsi')" />
                        <x-text-area id="deskripsi" class="block w-full mt-1" type="text" name="deskripsi">{{ old('deskripsi')}}</x-text-area>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <x-primary-button class="justify-center w-full mt-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>
