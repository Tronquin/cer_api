<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Clave</th>
            <th>Traduccion</th>
        </tr>
        @foreach($keyTranslations as $keyTranslation)
            <tr>
                <td>{{ $keyTranslation->key }}</td>
                <td>{{ $keyTranslation->languages[0]->pivot->translation }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>