@include('cabezera')

<div style="margin-top: 100px;">
    <h1>{{ $title }}</h1>

    <form action="/filmin/update/{{ $film->id }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $film->name }}" required>
        </div>

        <div>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" value="{{ $film->year }}" required>
        </div>

        <div>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value="{{ $film->genre }}" required>
        </div>

        <div>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" value="{{ $film->country }}" required>
        </div>

        <div>
            <label for="duration">Duration (minutos):</label>
            <input type="number" id="duration" name="duration" value="{{ $film->duration }}" required>
        </div>

        <div>
            <label for="img_url">Image URL:</label>
            <input type="text" id="img_url" name="img_url" value="{{ $film->img_url }}" required>
        </div>

        <div>
            <button type="submit">Actualizar Película</button>
        </div>
    </form>
</div>

@include('piePagina')
