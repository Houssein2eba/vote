@extends('layout.template')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container my-4" id="vote-section">
    <div class="card shadow-lg p-4">
        <h3 class="text-center">قم بالتصويت للنقابة التي تمثلك<br> votez pour votre le syndicat qui vous représente</h3>
        <form action="{{ route('store') }}" method="post" class="mt-3">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control @error('student_id') is-invalid @enderror" 
                       name="student_id" placeholder="رقم التسجيل - No d'inscription" value="{{ old('student_id') }}">
                @error('student_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <select name="institution" class="form-control @error('institution') is-invalid @enderror">
                    <option value="iup" {{ old('institution') == 'iup' ? 'selected' : '' }}>IUP</option>
                </select>
                @error('institution')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="row text-center">
                @php
                    $selected_union = old('union_id');
                @endphp
                @foreach([1 => 'UGEM 01', 2 => 'UNEM 02', 3 => 'SNEM 03', 4 => 'ANEM 04'] as $id => $name)
                <div class="col-md-3">
                    <label class="d-block p-3 border rounded-3">
                        <img src="{{ asset('imgs/union' . $id . '.jpg') }}" alt="{{ $name }}" class="img-fluid rounded">
                        <p>{{ $name }}</p>
                        <input type="radio" name="union_id" value="{{ $id }}" required {{ $selected_union == $id ? 'checked' : '' }}>
                    </label>
                </div>
                @endforeach
            </div>

            @error('union_id')
            <div class="text-danger text-center">
                {{ $message }}
            </div>
            @enderror

            <button type="submit" class="btn btn-success w-100 mt-3">تصويت<br>Voter</button>
        </form>
    </div>
</div>

@endsection
