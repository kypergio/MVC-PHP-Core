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

    // index  - Lista todos los elementos
    // show   - Mostrar un elemento específico por id
    // create - Crear un elemento
    // update - Editar un elemento
    // delete - Borrar un elemento
}
