@extends('layouts.app')
@section('title', 'Create category')

@section('content')
<div class="container">
    <h1>Create category</h1>
    <div class="mb-4">
        {{-- TODO: Link --}}
        <a href="#"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>
    </div>

    @if (Session::has('category_created'))
    <div class="alert alert-success">
        Sikeresen létrehoztad a kategóriát: <span class="badge bg-{{ session('style') }}">{{ session('name') }}</span>
    </div>
        
    @endif

    
    {{-- TODO: Session flashes --}}

    {{-- TODO: action, method --}}
    <form method="POST" action="{{ route('categories.store') }}">
    @csrf
        <div class="form-group row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="style" class="col-sm-2 col-form-label py-0">Style*</label>
            <div class="col-sm-10">
                @foreach (\App\Models\Category::$styles as $style)
                    <div class="form-check">
                        <input
                            class="form-check-input @error('style') is-invalid @enderror"
                            type="radio"
                            name="style"
                            id="{{ $style }}"
                            @checked(old('style') == $style)
                            value="{{ $style }}"
                            {{-- TODO: checked --}}
                        >
                        <label class="form-check-label" for="{{ $style }}">
                            <span class="badge bg-{{ $style }}">{{ $style }}</span>
                        </label>
                        @if ($loop->last)  
                            @error('style')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror              
                        @endif
                    </div>
                @endforeach
                {{-- TODO: Error handling --}}

            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
        </div>

    </form>
</div>
@endsection
