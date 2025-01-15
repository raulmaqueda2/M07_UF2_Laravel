@include('cabezera')
<div style="margin-top: 100px;">
    <h1>{{$title}}</h1>

    @if(empty($films))
        <FONT COLOR=" red">No se ha encontrado ninguna película</FONT>
    @else
        <div align="center">
            <table border="1">
                <tr>
                </tr>

                @if (isset($films[0]))
                    @foreach($films as $film)
                        @foreach(array_keys($film) as $key)
                            <th>{{$key}}</th>
                        @endforeach
                        @break
                    @endforeach

                    @foreach($films as $film)
                        <tr>
                            <td>{{$film['name']}}</td>
                            <td>{{$film['year']}}</td>
                            <td>{{$film['genre']}}</td>
                            <td>{{$film['country']}}</td>
                            <td>{{$film['duration']}}</td>
                            <td><img src={{$film['img_url']}} style="width: 100px; heigth: 120px;" /></td>
                        </tr>
                    @endforeach
                @else
                    <p>{{$films['Cantidad de peliculas']}}</p>

                @endif
            </table>
        </div>
    @endif
</div>
@include('piePagina')
