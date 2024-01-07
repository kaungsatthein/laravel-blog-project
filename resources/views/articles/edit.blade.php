@extends('layouts.app')
@section('content')
    <div class="container" style="max-width: 800px">

        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="post">
            @csrf
            <div class="mb-2">
                <label>Title</label>
                <input type="text" class="form-control" name="title" value="{{ $articles->title }}">
            </div>
            <div class="mb-2">
                <label>Body</label>
                <textarea name="body" class="form-control">{{ $articles->body }}</textarea>
            </div>
            <div class="mb-4">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}"
                        {{ $articles->category_id == $category->id ? "selected" : ""}}>
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>

@endsection
