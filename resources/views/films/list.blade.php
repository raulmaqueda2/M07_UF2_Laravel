<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <select name="film" id="film-select">
                @foreach ($films as $film)
                    <option value="{{ $film->id }}">{{ $film->title }}</option>
                @endforeach
            </select>
            <button type="submit">Editar película</button>
        </div>
    </div>
</div>
@include('cabezera')
<div style="margin-top: 100px;">
    <h1>{{ $title }}</h1>

    @if (empty($films) || count($films) == 0)
        <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
    @else
        <div align="center">
            <table border="1" style="border-collapse: collapse; width: 80%;">
                <tr>
                    <th>name</th>
                    <th>year</th>
                    <th>genre</th>
                    <th>country</th>
                    <th>duration</th>
                    <th>img</th>
                </tr>

                @foreach ($films as $film)
                    <tr>
                        <td>{{ $film->name }}</td>
                        <td>{{ $film->year }}</td>
                        <td>{{ $film->genre }}</td>
                        <td>{{ $film->country }}</td>
                        <td>{{ $film->duration }}</td>
                        <td><img src="{{ $film->img_url }}" style="width: 100px; height: 120px;" /></td>
                        <td>
                            <form action="/filmin/updateFilm/{{ $film->id }}" method="GET">
                                <button>
                                    <img style="width: 50px; height: 50px;" src="/img/edit.jpg" alt="">
                                </button>
                            </form>
                            <form action="/filmin/deleteFilm/{{ $film->id }}" method="GET">
                                <button>
                                    <img style="width: 50px; height: 40px;" src="/img/del.png" alt="">
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
</div>
@include('piePagina')
