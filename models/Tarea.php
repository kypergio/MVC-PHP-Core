<?php
class Tarea extends DB
{
    public $id;
    public $nombre;
    public $vencimiento;

    public static function all()
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM tareas");
        $prepare->execute();

        return $prepare->fetchAll(PDO::FETCH_CLASS, Tarea::class);
    }
    public static function find($id)
    {
        $db = new DB();
        $prepare = $db->prepare("SELECT * FROM tareas WHERE id=:id");
        $prepare->execute([":id" => $id]);

        return $prepare->fetchObject(Tarea::class);
    }

    public function save()
    {
        $params = [":nombre" => $this->nombre, ":vencimiento" => $this->vencimiento];
        if (empty($this->id)) {
            $prepare = $this->prepare("INSERT INTO tareas(nombre, vencimiento) VALUES (:nombre, :vencimiento)");
            $prepare->execute($params);

            $prepare2 = $this->prepare("SELECT MAX(id) id FROM tareas");
            $prepare2->execute();
            $this->id = $prepare2->fetch(PDO::FETCH_ASSOC)["id"];
        } else {
            $params[":id"] = $this->id;
            $prepare = $this->prepare("UPDATE tareas SET nombre=:nombre, vencimiento=:vencimiento WHERE id=:id");
            $prepare->execute($params);
        }
    }
    public function remove()
    {
        $prepare = $this->prepare("DELETE FROM tareas WHERE id=:id");
        $prepare->execute([":id" => $this->id]);
    }
}
