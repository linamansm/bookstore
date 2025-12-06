@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a New Book</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/books') }}" method="POST">
        @csrf
        <div>
            <label for="aname">Book Name:</label>
            <input type="text" name="aname" id="aname" value="{{ old('aname') }}" required>
            @error('aname')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required>
            @error('price')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="bname">Book Name:</label>
            <input type="text" name="bname" id="bname" value="{{ old('bname') }}" required>
            @error('bname')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="avaiable">Book Name:</label>
            <input type="text" name="avaiable" id="avaiable" required>
            @error('avaiable')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="image_path">Book Name:</label>
            <input type="file" name="image_path" id="image_path" value="{{ old('image_path') }}" required>
            @error('image_path')<div style="color:red;">{{ $message }}</div>@enderror
        </div>

        <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ isset($book) && $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

        <button type="submit">Add Book</button>
    </form>
</div>
@endsection
