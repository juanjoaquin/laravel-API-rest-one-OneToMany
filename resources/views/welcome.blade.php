<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <table>
        <thead>
            <th>Description</th>
            <th>Stock</th>
            <th>Caetgoria</th>
        </thead>

        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{$product->description }}</td>
                <td>{{$product->stock }}</td>
                <td>{{$product->categories->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>