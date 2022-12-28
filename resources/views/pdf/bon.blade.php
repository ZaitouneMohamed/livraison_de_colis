<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 class="btn btn-submit">exporter {{ $colis->count() }} colis </h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID Colis</th>
                <th>Telephone</th>
                <th>destinataire</th>
                <th>Ville</th>
                <th>prix</th>
                <th>date d'ajout</th>
                <th>Etat</th>
                <th>produit</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($colis as $coli)    
                <tr>
                    <td>{{ $coli->id }}</td>
                    <td>{{ $coli->destinataire }}</td>
                    <td>{{ $coli->telephone }}</td>
                    <td>{{ $coli->ville }}</td>
                    <td>{{ $coli->prix }}</td>
                    <td>{{ $coli->created_at }}</td>
                    <td>{{ $coli->statue }}</td>
                    <td>{{ $coli->products }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
