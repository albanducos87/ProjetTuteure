<?php

class MasquerResponsableEntrepriseManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($masquerResponsableEnt)
    {
        $requete = $this->db->prepare('INSERT INTO masquerresponsableentreprise  (
                 idResponsableEnt)VALUES(:idResponsableEnt);');

        $requete->bindValue(':idResponsableEnt', $masquerResponsableEnt->get_Id_Responsable_Ent());

        $retour = $requete->execute();
        return $retour;
    }
    
    public function masquerResponsableEnt($idResponsableEnt){
        $sql = 'INSERT INTO masquerresponsableentreprise (
                 idResponsableEnt)VALUES(:idResponsableEnt);';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idResponsableEnt',$idResponsableEnt);
        $requete->execute();
        $requete->closeCursor();
    }
}
?>