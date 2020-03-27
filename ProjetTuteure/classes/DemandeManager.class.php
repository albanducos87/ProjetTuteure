<?php
class DemandeManager
{

    private $dbo;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($demande)
    {
        $requete = $this->db->prepare('INSERT INTO demande (
                 id_etudiant, id_stage,accepte)VALUES(:idEtudiant, :idStage, :accepte);');

        $requete->bindValue(':idEtudiant', $demande->getId_etudiant());
        $requete->bindValue(':idStage', $demande->getId_stage());
        $requete->bindValue(':accepte', $demande->getAccepte());

        $retour = $requete->execute();
        return $retour;
    }
    public function getAllDemandes(){
        $demandes = array();

        $sql = 'SELECT * FROM demande';

        $requete = $this->db->prepare($sql);
        $requete->execute();
        while ($demande = $requete->fetch(PDO::FETCH_OBJ)){
            $demandes[] = new Demande($demande);
        }
        $requete->closeCursor();
        return $demandes;
    }
    public function getAllDemande($idPersonne)
    {
        $demandes = array();

        $sql = 'SELECT * FROM demande WHERE idEtudiant = :idPersonne';

        $requete = $this->db->prepare($sql);
        $requete->bindValue('idPersonne', $idPersonne);
        $requete->execute();

        while ($demande = $requete->fetch(PDO::FETCH_OBJ))
            $demandes[] = new Demande($demande);

        $requete->closeCursor();
        return $demandes;
    }

    public function getIdStage()
    {
        $sql = 'SELECT idStage FROM stage';

        $requete = $this->db->prepare($sql);
        $requete->execute();
        $idstage = $requete->fetchColumn();
        $requete->closeCursor();
        return $idstage;
    }

    public function getAccepted($idStage, $idPersonne)
    {
        $sql = 'SELECT accepte FROM demande WHERE idStage = :idStage AND idEtudiant = :idPersonne';

        $requete = $this->db->prepare($sql);
        $requete->bindValue('idStage', $idStage);
        $requete->bindValue('idPersonne', $idPersonne);
        $requete->execute();
        $accepte = $requete->fetchColumn();
        $requete->closeCursor();
        return $accepte;
    }

    public function etudiantAUnStageEnCours($idEtudiant)
    {
        $sql = 'SELECT idEtudiant FROM etudiant WHERE idEtudiant IN (SELECT idEtudiant FROM demande WHERE idEtudiant = :idEtudiant AND accepte = 1)';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idEtudiant', $idEtudiant);
        $requete->execute();
        $num = $requete->fetchColumn();
        $requete->closeCursor();
        return $num;
    }

    public function getIdEtuByIdStage($idStage){
        $idetu = array();

        $sql = 'SELECT idEtudiant FROM demande WHERE idStage = :idStage';

        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idStage', $idStage);
        $requete->execute();
        while($etu = $requete->fetch(PDO::FETCH_OBJ)){
            $idetu[] = new Demande($etu);
        }

        return $idetu;
    }

    public function deleteDemandeEtudiant($idEtudiant){
        $sql = 'DELETE FROM demande WHERE idEtudiant = :idEtudiant';

        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idEtudiant', $idEtudiant);
        $requete->execute();
        $requete->closeCursor();
    }

    public function deleteDemandeByIdStage($idStage){
        $sql = 'DELETE FROM demande WHERE idStage = :idStage';

        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idStage', $idStage);
        $requete->execute();
        $requete->closeCursor();
    }

    public function deleteDemandeByIdStageIdEtudiant($idStage,$idEtudiant){
        $sql = 'DELETE FROM demande WHERE idStage = :idStage AND idEtudiant = :idEtudiant';

        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idStage', $idStage);
        $requete->bindValue(':idEtudiant', $idEtudiant);
        $requete->execute();
        $requete->closeCursor();
    }

    public function getEtudiantIfAccepted($idEtudiant){
        $sql = 'SELECT * FROM demande WHERE idEtudiant = :idEtudiant and accepte = 1';

        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idEtudiant', $idEtudiant);
        $requete->execute();
        $demande = $requete->fetch(PDO::FETCH_OBJ);
        if(!empty($demande)){
            $demande = new Demande($demande);
            return $demande;
        }
        return null;
    }
    
    public function getAllDemandesByIdEtablissement($idEtablissement){
        $demandes = array();
        
        $sql = 'SELECT * FROM demande WHERE idEtudiant IN (SELECT idEtudiant FROM etudiant WHERE idEtablissement = :idEtablissement)';
        
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idEtablissement', $idEtablissement);
        $requete->execute();
        while ($demande = $requete->fetch(PDO::FETCH_OBJ)){
            $demandes[] = new Demande($demande);
        }
        $requete->closeCursor();
        return $demandes;
    }
    
    public function postuler($idPersonne, $idStage, $cvNum){
        $sql = 'INSERT INTO demande (
                 idEtudiant, idStage,accepte,idCV)VALUES(:idEtudiant, :idStage, 0, :idCV)';
        $requete = $this->db->prepare($sql);
        $requete->bindValue(':idEtudiant',$idPersonne);
        $requete->bindValue(':idStage',$idStage);
        $requete->bindValue(':idCV',$cvNum);
        $requete->execute();
        $requete->closeCursor();
    }
}