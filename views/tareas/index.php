<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Lista de tareas</h1>
        <button class="btn btn-success">Agregar</button>
        <table class="table table-striped mt-4" id="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Vencimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?php echo $task->id; ?></td>
                        <td><?php echo $task->nombre; ?></td>
                        <td><?php echo $task->vencimiento; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="tareasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="nombre" value="Nombre" class="form-control" placeholder="*">
                        <label>Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="vencimiento" value="2022-01-01" class="form-control" placeholder="*">
                        <label>Vencimiento</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let myModal = null;
        document.querySelector('.btn.btn-success')
            .addEventListener('click', () => {
                myModal = new bootstrap.Modal(document
                    .getElementById('tareasModal'))
                myModal.show();

            });
        document.querySelector('.btn-guardar')
            .addEventListener('click', () => {
                let nombre = document.querySelector('input[name="nombre"]').value;
                let vencimiento = document.querySelector('input[name="vencimiento"]').value;
                axios.post('http://localhost/mvc/tareas/create', {
                        nombre,
                        vencimiento
                    })
                    .then((r) => {
                        console.log(r);
                        let info = r.data;
                        let tr = document.createElement("tr");
                        tr.innerHTML = `<td>${info.id}</td>
                                        <td>${info.nombre}</td>
                                        <td>${info.vencimiento}</td>`;
                        document.getElementById("table")
                            .querySelector("tbody").append(tr);
                        myModal.hide();

                    })
            })
    </script>
</body>

</html>