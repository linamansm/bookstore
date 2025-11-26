<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $book->bname }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6 max-w-3xl">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            
            <!-- Book Image -->
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->bname }}" class="w-full h-64 object-cover rounded mb-6">
            @else
                <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 mb-6 rounded flex items-center justify-center text-gray-500">
                    No Image
                </div>
            @endif

            <!-- Book Info -->
            <h1 class="text-2xl font-bold mb-2">{{ $book->bname }}</h1>
            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Author:</strong> {{ $book->aname }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Description:</strong> {{ $book->description }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-1"><strong>Available:</strong> {{ $book->available }}</p>
            <p class="text-gray-700 dark:text-gray-300 mb-4"><strong>Price:</strong> ${{ $book->price }}</p>

            <!-- Admin Buttons -->
            @if(auth()->user()->role === 'admin')
                <div class="flex space-x-3">
                    <!-- Edit -->
                    <a href="{{ route('book.edit', $book->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Edit</a>

                    <!-- Delete -->
                    <form action="{{ route('book.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Favorite Toggle (AJAX, no refresh) -->
<label class="inline-flex items-center cursor-pointer mt-4">
    <input type="checkbox" id="favoriteToggle" class="sr-only peer"
        {{ $book->favorite ? 'checked' : '' }}>
    
    <div class="w-14 h-7 bg-gray-300 peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full
        peer dark:bg-gray-700 peer-checked:bg-yellow-500 transition-all"></div>
    
    <span class="ml-3 text-gray-700 dark:text-gray-300">
        Add to Favorite
    </span>
</label>

<script>
document.getElementById('favoriteToggle').addEventListener('change', function () {
    fetch("{{ route('book.favorite', $book->id) }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            favorite: this.checked ? 1 : 0
        })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            console.log("Favorite updated!");
        } else {
            console.error("Failed to update favorite");
        }
    })
    .catch(err => console.error(err));
});

</script>



        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('book.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Back to Books</a>
        </div>
    </div>
</x-app-layout>
