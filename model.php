<?php
// model.php
class Pokemon {
    private $id;
    private $name;
    private $weight;
    private $species;
    private $type_id;

    public function __construct($id, $name, $weight, $species, $type_id = null) {
        $this->id = (int)$id;
        $this->name = $name;
        $this->weight = $weight;
        $this->species = $species;
        $this->type_id = $type_id === null ? null : (int)$type_id;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getWeight() { return $this->weight; }
    public function getSpecies() { return $this->species; }
    public function getTypeId() { return $this->type_id; }

    // Setters
    public function setName($name) { $this->name = $name; }
    public function setWeight($weight) { $this->weight = $weight; }
    public function setSpecies($species) { $this->species = $species; }
    public function setTypeId($type_id) { $this->type_id = ($type_id === null ? null : (int)$type_id); }
}

class Type {
    private $id;
    private $name;
    private $pro;
    private $contra;

    public function __construct($id, $name, $pro, $contra) {
        $this->id = (int)$id;
        $this->name = $name;
        $this->pro = $pro;
        $this->contra = $contra;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getPro() { return $this->pro; }
    public function getContra() { return $this->contra; }

    public function setName($name) { $this->name = $name; }
    public function setPro($pro) { $this->pro = $pro; }
    public function setContra($contra) { $this->contra = $contra; }
}
