<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6 max-w-lg">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <!-- Book Name -->
            <div class="mb-4">
                <label for="bname" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Book Name</label>
                <input type="text" name="bname" id="bname" value="{{ old('bname', $book->bname) }}" class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-gray-200">
                @error('bname') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Author Name -->
            <div class="mb-4">
                <label for="aname" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Author Name</label>
                <input type="text" name="aname" id="aname" value="{{ old('aname', $book->aname) }}" class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-gray-200">
                @error('aname') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Available -->
            <div class="mb-4">
                <label for="available" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Available</label>
                <input type="string" name="available" id="available" value="{{ old('available', $book->available) }}" class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-gray-200">
                @error('available') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Price</label>
                <input type="string" name="price" id="price" value="{{ old('price', $book->price) }}" class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-gray-200">
                @error('price') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 dark:text-gray-300 font-medium mb-1">Book Image</label>
                <input type="file" name="image" id="image" class="w-full px-3 py-2 border rounded dark:bg-gray-700 dark:text-gray-200">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->bname }}" class="w-32 h-32 object-cover mt-2 rounded">
                @endif
                @error('image') <p class="text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Update Book
            </button>
        </form>
    </div>
</x-app-layout>
