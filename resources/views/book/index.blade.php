<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">

        @foreach($books as $book)
        <a href="{{ route('book.show', $book->id) }}" class="block group">
            <div class="bg-white dark:bg-gray-900 rounded-md shadow hover:shadow-lg transition-shadow duration-200 p-2 flex flex-col items-center text-center">

                <!-- Book Image -->
                <div class="w-[100px] h-[100px] rounded-md overflow-hidden mb-2">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" 
                             alt="{{ $book->bname }}" 
                             class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-200">
                    @else
                        <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 text-xs font-semibold">
                            No Image
                        </div>
                    @endif
                </div>

                <!-- Book Info -->
                <h2 class="text-sm font-bold text-gray-800 dark:text-gray-100 group-hover:text-indigo-500 truncate">
                    {{ $book->bname }}
                </h2>
                <p class="text-xs text-gray-600 dark:text-gray-300 truncate"><span class="font-semibold">Author:</span> {{ $book->aname }}</p>
                <p class="text-xs text-gray-600 dark:text-gray-300 truncate"><span class="font-semibold">Avail:</span> {{ $book->available }}</p>
                <p class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                    ${{ $book->price }}
                </p>

                <!-- Admin Buttons -->
                @if(auth()->user()->role === 'admin')
                <div class="flex flex-col gap-1 mt-1">
                    <a href="{{ route('book.edit', $book->id) }}" 
                       class="bg-indigo-500 hover:bg-indigo-600 text-white px-2 py-1 rounded text-xs">
                        Edit
                    </a>
                    <form action="{{ route('book.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">
                            Delete
                        </button>
                    </form>
                </div>
                @endif

            </div>
        </a>
        @endforeach

    </div>
</x-app-layout>
