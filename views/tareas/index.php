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
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task) : ?>
          <tr data-id="<?php echo $task->id; ?>">
            <td><?php echo $task->id; ?></td>
            <td><?php echo $task->nombre; ?></td>
            <td><?php echo $task->vencimiento; ?></td>
            <td>
              <button class="btn btn-warning btnEditar">Editar</button>
              <button class="btn btn-danger btnEliminar">Eliminar</button>
            </td>
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
            <input type="text" name="nombre" class="form-control" placeholder="*">
            <label>Nombre</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="vencimiento" class="form-control" placeholder="*">
            <label>Vencimiento</label>
          </div>
        </div>
        <input type="hidden" id="identificador" value="">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary btn-guardar">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    let myModal = new bootstrap.Modal(document.getElementById('tareasModal'));

    const fetchTarea = (event) => {
      let id = event.target.parentNode.parentNode.dataset.id;
      axios.get(`http://localhost/mvc/tareas/find/${id}`).then((res) => {
        let info = res.data;
        document.querySelector("#exampleModalLabel").innerHTML = "Editar Tarea";
        document.querySelector('input[name="nombre"]').value = info.nombre;
        document.querySelector('input[name="vencimiento"]').value = info.vencimiento;
        document.querySelector('#identificador').value = id;
        myModal.show();
      })
    }

    const deleteTarea = (event) => {
      let id = event.target.parentNode.parentNode.dataset.id;
      axios.delete(`http://localhost/mvc/tareas/delete/${id}`).then((res) => {
        let info = res.data;
        if (info.status) {
          document.querySelector(`tr[data-id="${id}"]`).remove();
        }
      })
    }

    document.querySelector('.btn.btn-success')
      .addEventListener('click', () => {
        document.querySelector("#exampleModalLabel").innerHTML = "Crear Tarea";
        document.querySelector('input[name="vencimiento"]').value = ""
        document.querySelector('input[name="nombre"]').value = ""
        myModal.show();

      });
    document.querySelector('.btn-guardar')
      .addEventListener('click', () => {
        let nombre = document.querySelector('input[name="nombre"]').value;
        let vencimiento = document.querySelector('input[name="vencimiento"]').value;
        let id = document.querySelector('#identificador').value;
        axios.post(`http://localhost/mvc/tareas/${id == "" ? 'create' : 'update'}`, {
            nombre,
            vencimiento,
            id
          })
          .then((r) => {
            let info = r.data;
            if (id == "") {
              // Agregar
              let tr = document.createElement("tr");
              tr.setAttribute('data-id', info.id);
              tr.innerHTML = `<td>${info.id}</td>
                              <td>${info.nombre}</td>
                              <td>${info.vencimiento}</td>
                              <td><button class='btn btn-warning btnEditar'>Editar</button>
                              <button class='btn btn-danger btnEliminar'>Eliminar</button></td>`;
              document.getElementById("table")
                .querySelector("tbody").append(tr);
              tr.querySelector('td:last-child .btnEditar')
                .addEventListener('click', fetchTarea);
              tr.querySelector('td:last-child .btnEliminar')
                .addEventListener('click', deleteTarea);
            } else {
              // Editar
              let tr = document.querySelector(`tr[data-id="${id}"]`);
              let cols = tr.querySelectorAll("td");
              cols[1].innerText = info.nombre;
              cols[2].innerText = info.vencimiento;
            }
            myModal.hide();

          })
      })
    let btnsEditar = document.querySelectorAll('.btnEditar');
    let btnsEliminar = document.querySelectorAll('.btnEliminar');
    for (let i = 0; i < btnsEditar.length; i++) {
      btnsEditar[i].addEventListener('click', fetchTarea);
      btnsEliminar[i].addEventListener('click', deleteTarea);
    }
  </script>
</body>

</html>