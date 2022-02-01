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
       
    }

    // index  - Lista todos los elementos
    // show   - Mostrar un elemento específico por id
    // create - Crear un elemento
    // update - Editar un elemento
    // delete - Borrar un elemento
}
