<?php
class Database extends PDO
{
    public function __construct() {
        parent::__construct('mysql:host=localhost:3306;dbname=labora41_bd_arca','labora41_root','ArcaRoot_2017');
    }
}
?>