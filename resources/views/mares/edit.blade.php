<x-layout>

    <x-slot:heading>
        Modification de la mare {{  $mare->id }}
    </x-slot:heading>


    <form method="POST" action="/mares/{{ $mare->id }}">

        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="latitude" class="block text-sm font-medium leading-6 text-gray-900">Latitude</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="latitude" id="latitude"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="43.25513" value="{{ $mare->latitude }}" required>
                            </div>

                            @error('latitude')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="longitude"
                            class="block text-sm font-medium leading-6 text-gray-900">Longitude</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="longitude" id="longitude"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="3.22167" value={{ $mare->longitude }} required>
                            </div>
                            @error('longitude')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>



                </div>
            </div>




        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>
            <div class="flex items-center gap-x-6">

            <a  href="/mares/{{ $mare->id }}" class="text-sm font-semibold leading-6 text-gray-900">Annuler</a>

                <div>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>

    <form method="POST" action="/mares/{{ $mare->id }}" class="hidden" id="delete-form">
        @csrf
        @method('DELETE')

      </form>




</x-layout>
