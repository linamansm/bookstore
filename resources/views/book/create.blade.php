<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <p class="text-green-500">{{ session('success') }}</p>
                @endif

                @if ($errors->any())
                    <ul class="text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label>Author Name:</label>
                    <input type="text" name="aname" value="{{ old('aname') }}" class="border p-2 w-full mb-4">

                    <label>Book Name:</label>
                    <input type="text" name="bname" value="{{ old('bname') }}" class="border p-2 w-full mb-4">

                    <label>Description:</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="border p-2 w-full mb-4">

                    <label>Price:</label>
                    <input type="text" name="price" value="{{ old('price') }}" class="border p-2 w-full mb-4">

                    <label>Available:</label>
                    <input type="text" name="available" value="{{ old('available') }}" class="border p-2 w-full mb-4">

                    <div class="mb-3">
                    <label for="image" class="form-label">image</label>
                    <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">
                    </div>


                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Send
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
