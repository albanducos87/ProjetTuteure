<?php

class MasquerEtudiantManager
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($masquerEtudiant)
    {
        $requete = $this->db->prepare('INSERT INTO masquerEtudiant (
                 id_etudiant)VALUES(:idEtudiant);');

        $requete->bindValue(':idEtudiant', $masquerEtudiant->getId_etudiant());

        $retour = $requete->execute();
        return $retour;
    }
    
    public function masquerEtu($idEtu){
        $sql = 'INSERT INTO masqueretudiant (
                 idEtudiant)VALUES(:idEtudiant);';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idEtudiant',$idEtu);
        $requete->execute();
        $requete->closeCursor();
    }
}
?>