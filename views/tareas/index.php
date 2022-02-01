<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <table class="table table-striped mt-4" id="table">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Vencimiento</th>
        </tr>
        <?php foreach ($tasks as $task) : ?>
            <tr>
                <td><?php echo $task->id; ?></td>
                <td><?php echo $task->nombre; ?></td>
                <td><?php echo $task->vencimiento; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>