<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <!-- <div class="container mx-auto mt-6">
        <h1 class="text-2xl font-bold mb-4">Books List</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($books as $book)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5 hover:shadow-xl transition-shadow duration-300">
                    <h2 class="text-lg font-semibold mb-2">{{ $book->bname }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-1"><strong>Author:</strong> {{ $book->aname }}</p>
                    <p class="text-gray-600 dark:text-gray-300 mb-1"><strong>Available:</strong> {{ $book->available }}</p>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Price:</strong> ${{ $book->price }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>




<div class="px-2 py-20 w-full flex justify-center">
    <div class="bg-white lg:mx-8 lg:flex lg:max-w-5xl lg:shadow-lg rounded-lg">
        <div class="lg:w-1/2">
            <div class="lg:scale-110 h-80 bg-cover lg:h-full rounded-b-none border lg:rounded-lg"
                style="background-image:url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97')">
            </div>
        </div>
        <div class="py-12 px-6 lg:px-12 max-w-xl lg:max-w-5xl lg:w-1/2 rounded-t-none border lg:rounded-lg">
            <h2 class="text-3xl text-gray-800 font-bold">
                {{ $book->aname }}
                <span class="text-indigo-600">{{ $book->bname }}</span>
            </h2>
            <p class="mt-4 text-gray-600">
                Availablity:{{ $book->available }}
            </p>
            <div class="mt-8">
                <a href="#" class="bg-gray-900 text-gray-100 px-5 py-3 font-semibold rounded">${{ $book->price }}</a>
            </div>
        </div>
    </div>
</div> -->


<div class="container mx-auto mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach($books as $book)
        <a href="{{ route('book.show', $book->id) }}" class="block group">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-5 hover:shadow-xl transition-shadow duration-300 relative">

                <!-- Book Image -->
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->bname }}" class="w-full h-48 object-cover mb-3 rounded">
                @else
                    <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 mb-3 rounded flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif

                <!-- Book Info -->
                <h2 class="text-lg font-semibold mb-2 group-hover:text-blue-500">{{ $book->bname }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-1"><strong>Author:</strong> {{ $book->aname }}</p>
                <p class="text-gray-600 dark:text-gray-300 mb-1"><strong>Available:</strong> {{ $book->available }}</p>
                <p class="text-gray-600 dark:text-gray-300 mb-3"><strong>Price:</strong> ${{ $book->price }}</p>

                <!-- Admin Buttons -->
                @if(auth()->user()->role === 'admin')
                    <div class="flex justify-between mt-3 z-10 relative">
                        <a href="{{ route('book.edit', $book->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Edit</a>

                        <form action="{{ route('book.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                        </form>
                    </div>
                @endif

            </div>
        </a>
    @endforeach
</div>
