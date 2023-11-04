
<h3 class="text-center">
    Jualan
</h3>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<table class="table text-center table-dark"> 
    <thead> 
        <tr> 
            <th scope="col">Nama</th> 
            <th scope="col">Harga</th>
            <th scope="col">Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($foods as $item)
        <tr class="py-4">
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->descriptions}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
