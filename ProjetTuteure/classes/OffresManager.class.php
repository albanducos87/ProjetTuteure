<?php
	
	class OffresManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($offre){
            $requete = $this->pdo->prepare(
			     'INSERT INTO offres (
                 idProposition, idEntreprise, idStage)VALUES(:idProposition, :idEntreprise, :idStage);'); 

            $requete->bindValue(':idProposition',$cv->getIdProposition());
			$requete->bindValue(':idEntreprise',$cv->getIdEntreprise());
            $requete->bindValue(':idStage',$cv->getIdStage());

            $retour=$requete->execute();
			return $retour;
         }

         public function getListOffres() {
             $listeOffres = array();
             $sql = 'SELECT * FROM stage s JOIN offres o ON o.idStage = s.idStage';
             $req = $this->pdo->query($sql);
             while ($offre = $req->fetch(PDO::FETCH_OBJ)) {
                 $listeOffres[] = new Offres($offre);
             }
             return $listeOffres;
             $req->closeCursor();
         }

         public function getAllOffres($idPersonne){
            $offres = array();

            $sql = 'SELECT idResponsableEnt FROM responsableentreprise r
                    JOIN offres o ON o.idEntreprise = r.idEntreprise
                    WHERE idResponsableEnt = :idPersonne';

            $requete = $this->pdo->prepare($sql);
            $requete->bindValue('idPersonne',$idPersonne);
            $requete->execute();

            while ($offre = $requete->fetch(PDO::FETCH_OBJ))
                    $offres[] = new Offres($offre);

            $requete->closeCursor();
            return count($offres);
         }

         public function nombreOffres(){
            $nombreOffres = array();
            $sql = 'SELECT * FROM offres';
            $requete = $this->pdo->prepare($sql);
            $requete->execute();
            while($offre = $requete->fetch(PDO::FETCH_OBJ)){
                $nombreOffres[] = new Offres($offre);
            }
            $requete->closeCursor();
            return count($nombreOffres);
         }

         public function nomEntreprise($numero){
            $nomEntreprise = array();
            $sql = 'SELECT nomEntreprise FROM stage s 
                    JOIN offres o ON o.idStage = s.idStage 
                    JOIN entreprise e ON e.idEntreprise = o.idEntreprise
                    WHERE idProposition = :num';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':num',$numero);
            $requete->execute();
            while ($offre = $requete->fetch(PDO::FETCH_OBJ))
                $nomEntreprise[] = new Offres($offre);
            $requete->closeCursor();
            return $nomEntreprise;
         }

         public function getDescriptionById($idStage){
            $sql = 'SELECT descriptionStage FROM stage s
                    JOIN offres o ON o.idStage = s.idStage
                    WHERE s.idStage = :idStage';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $description = $requete->fetchColumn();
            $requete->closeCursor();
            return $description;
         }
         public function getTitreById($idStage){
            $sql = 'SELECT titre FROM stage s
                    JOIN offres o ON o.idStage = s.idStage
                    WHERE s.idStage = :idStage';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $titre = $requete->fetchColumn();
            $requete->closeCursor();
            return $titre;
         }
          public function getMissionById($idStage){
            $sql = 'SELECT mission FROM stage s
                    JOIN offres o ON o.idStage = s.idStage
                    WHERE s.idStage = :idStage';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $mission = $requete->fetchColumn();
            $requete->closeCursor();
            return $mission;
         }
        public function getStageByIdResponsable($idResponsable){
            $array = array();
            $sql = 'SELECT idStage, dateDebut, nbSemaines, mission,langueRequise, descriptionStage,titre, hebergement, idEntreprise,idDiplome, idVille, etat FROM stage WHERE idStage ='.$idStage;
            $requete = $this->db->prepare($sql);
            $requete->execute();
            while ($Stage = $requete->fetch(PDO::FETCH_OBJ)){
                $array[] = new Stage($Stage);
            }
            return $array;

        }               
    }
?>