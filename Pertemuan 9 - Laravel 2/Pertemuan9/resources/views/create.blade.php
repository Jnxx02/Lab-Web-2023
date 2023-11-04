<form method="POST" action="{{ route('Foods.store') }}">
    @csrf
    <label for="name">Name: </label> <br>
    <input type="text" name="name"> <br>
    <label for="price">Price: </label> <br>
    <input type="text" name="price"> <br>
    <label for="descriptions">Descriptions: </label> <br>
    <input type="text" name="descriptions"> <br>
    <input type="submit" value="Add">
</form>