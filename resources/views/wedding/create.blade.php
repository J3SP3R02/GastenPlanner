@extends('layout.index')
@section('content')

    <div>
        <form method="POST">
            @csrf
            <label><h3>Titel</h3></label>
            <input id="title" class="wedding-create" name="title" value="{{ old('title') }}"/>

            <label><h3>Omschrijving</h3></label>
            <input id="description" class="wedding-create" name="description" value="{{ old('description') }}"/>
        
            <br>
            <br>
            <button type="submit">Test</button>
        </form>
    </div>

@endsection
