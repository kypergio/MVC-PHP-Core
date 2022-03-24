<?php
class TareasController
{
  public function index()
  {
    $tareas = Tarea::all();
    view("tareas.index", ["tasks" => $tareas, "user" => "Cesar G"]);
  }

  public function create()
  {
    $data = json_decode(file_get_contents('php://input'));
    $tarea = new Tarea();
    $tarea->nombre = $data->nombre;
    $tarea->vencimiento = $data->vencimiento;
    $tarea->save();

    echo json_encode($tarea);
  }

  public function update()
  {
    $data = json_decode(file_get_contents('php://input')); // Convertir Json a stdClass
    $tarea = Tarea::find($data->id);
    $tarea->nombre = $data->nombre;
    $tarea->vencimiento = $data->vencimiento;
    $tarea->save();

    echo json_encode($tarea);
  }

  public function delete($id)
  {
    try {
      $tarea = Tarea::find($id);
      $tarea->remove();

      echo json_encode(['status' => true]);
    } catch (\Exception $e) {
      echo json_encode(['status' => false]);
    }
  }
  public function find($id)
  {
    $tarea = Tarea::find($id);

    echo json_encode($tarea);
  }

  // index  - Lista todos los elementos
  // show   - Mostrar un elemento específico por id
  // create - Crear un elemento
  // update - Editar un elemento
  // delete - Borrar un elemento
}
