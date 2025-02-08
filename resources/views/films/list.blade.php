@include('cabezera')
<div style="margin-top: 100px;">
    <h1>{{$title}}</h1>

    @if(empty($films) || count($films) == 0)
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

            @foreach($films as $film)
            <tr>
                <td>{{$film->name}}</td>
                <td>{{$film->year}}</td>
                <td>{{$film->genre}}</td>
                <td>{{$film->country}}</td>
                <td>{{$film->duration}}</td>
                <td><img src="{{$film->img_url}}" style="width: 100px; height: 120px;" /></td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif
</div>
@include('piePagina')