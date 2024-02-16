<?php

$perfil = $_SESSION['fk_id_perfil'];


class Menu
{
    private $_db;
    
    public function __construct(){
        $this->_db = new Database();
    }
    


    public function getMenu()
    {
        global $perfil;
        $menu = $this->_db->query("SELECT 
                                    n1.id,
                                    sm.titulo,
                                    sm.enlace
                                    FROM se_per_menu n1 
                                    LEFT OUTER JOIN se_menus sm ON (sm.id_menu = n1.fk_id_menu)
                                    WHERE n1.fk_id_perfil = '$perfil' AND n1.estado = 'A'");
        return $menu->fetchAll();
    }

    public function getSubMenu($id)
    {
        global $perfil;
        $menu = $this->_db->query("SELECT 
                                    n2.idsubmenu,
                                    n2.idmenu,
                                    sm.titulo,
                                    sm.enlace
                                    FROM se_per_submenu n2
                                    LEFT OUTER JOIN se_menus sm ON (sm.id_menu = n2.fk_id_menu)
                                    WHERE n2.fk_id_perfil = '$perfil' AND n2.idmenu = $id AND n2.estado = 'A'");
        return $menu->fetchAll();
    }


    public function getSubSubMenu($id)
    {
        global $perfil;
        $menu = $this->_db->query("SELECT 
                                    n3.idsubsubmenu,
                                    sm.titulo,
                                    sm.enlace
                                    FROM se_per_subsubmenu n3
                                    LEFT OUTER JOIN se_menus sm ON (sm.id_menu = n3.fk_id_menu)
                                    WHERE n3.fk_id_perfil = $perfil AND n3.idsubmenu = $id AND n3.estado = 'A'");
        return $menu->fetchAll();
    }

    public function getBarra()
    {
        global $perfil;
        $menu = $this->_db->query("SELECT pb.fk_id_menu,m.titulo,m.enlace FROM se_per_barra pb
                                    LEFT OUTER JOIN se_menus m ON (m.id_menu = pb.fk_id_menu)
                                    WHERE fk_id_perfil = $perfil AND pb.estado = 'A'");
        return $menu->fetchAll();
    }

    public function countBarra()
    {
        global $perfil;
        $menu = $this->_db->query("SELECT * FROM se_per_barra WHERE fk_id_perfil = $perfil AND estado = 'A'");
        return $menu->fetchAll();
    }


    public function countSub($id)
    {
        global $perfil;
        $menu = $this->_db->query("SELECT * FROM se_per_submenu WHERE fk_id_perfil = $perfil AND idmenu= $id");
        return $menu->fetchAll();
    }

    public function countSubSub($id)
    {
        global $perfil;
        $menu = $this->_db->query("SELECT * FROM se_per_subsubmenu WHERE fk_id_perfil = $perfil AND idsubmenu= $id");
        return $menu->fetchAll();
    }




    public function Carousel()
    {
        global $perfil;
        $menu = $this->_db->query("SELECT MIN(id_carrucel) minimo, COUNT(*) cantidad FROM so_carrucel WHERE estado = 'A'");
        return $menu->fetchAll();
    }

    public function SlideTo()
    {
        global $perfil;
        $menu = $this->_db->query("SELECT * FROM so_carrucel WHERE estado = 'A'");
        return $menu->fetchAll();
    }

    public function ImagenCarousel()
    {
        global $perfil;
        $menu = $this->_db->query("SELECT * FROM so_carrucel WHERE estado = 'A'");
        return $menu->fetchAll();
    }
}
?>