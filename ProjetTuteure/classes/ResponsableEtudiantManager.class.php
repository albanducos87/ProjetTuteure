<?php
	
	class ResponsableEtudiantManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($responsableEtudiant){
            $requete = $this->pdo->prepare(
			     'INSERT INTO responsableEtudiant (
                 id_responsable, id_etablissement)VALUES(:idResponsable, :idEtablissement);'); 

            $requete->bindValue(':idResponsable',$responsableEtudiant->getId_responsable());
			$requete->bindValue(':idEtablissement',$responsableEtudiant->getId_etablissement());

            $retour=$requete->execute();
			return $retour;
         }
         
         public function getIdEtablissementById($idResponsable){
             $sql = 'SELECT idEtablissement FROM responsableetudiant WHERE idResponsable = :idResponsable';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue('idResponsable',$idResponsable);
             $requete->execute();
             $idEta = $requete->fetchColumn();
             $requete->closeCursor();
             return $idEta;
         }
         
         public function insertResponsableEtu($idResponsable, $idEtablissement){
            $sql = 'INSERT INTO responsableetudiant VALUES (:idResponsable, :idEtablissement)';

            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idResponsable',$idResponsable);
            $requete->bindValue(':idEtablissement',$idEtablissement);
            $requete->execute();
            $requete->closeCursor();
         }

        public function deleteResponsableEtudiant($idResponsable){
            $sql = 'DELETE FROM responsableetudiant WHERE idResponsable = :idResponsable';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idResponsable', $idResponsable);
            $requete->execute();
            $requete->closeCursor();
        }

    }
?>