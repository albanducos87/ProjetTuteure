<?php
    
    class StageManager{
        private $dbo;

            public function __construct($db){
                $this->db = $db;
            }

        public function add($stage){
            $requete = $this->db->prepare(
                 'INSERT INTO stage (idStage,
                 dateDebut,nbSemaines,mission,langueRequise,descriptionStage,titre,hebergement,idEntreprise,idDiplome,idVille,etat,valide,datePub)VALUES(:idStage, :dateDebut, :nbsemaines, :mission, :langueRequise, :descriptionStage, :titre, :hebergement, :idEntreprise, :idDiplome, :idVille, :etat, :valide, :datePub);');

            $requete->bindValue(':idStage',$stage->getId_stage());
            $requete->bindValue(':dateDebut',$stage->getDateDebut());
            $requete->bindValue(':nbsemaines',$stage->getNbSemaines());
            $requete->bindValue(':mission',$stage->getMission());
            $requete->bindValue(':langueRequise',$stage->getLangueRequise());
            $requete->bindValue(':descriptionStage',$stage->getDescriptionStage());
            $requete->bindValue(':titre',$stage->getTitre());
            $requete->bindValue(':hebergement',$stage->getHebergement());
            $requete->bindValue(':idEntreprise',$stage->getId_entreprise());
            $requete->bindValue(':idDiplome',$stage->getId_diplome());
            $requete->bindValue(':idVille',$stage->getId_ville());
            $requete->bindValue(':etat',$stage->getEtat());
            $requete->bindValue(':valide',$stage->getValide());
            $requete->bindValue(':datePub',$stage->getDatePub());
            
            $retour=$requete->execute();
            return $retour;
         }



         public function getDescriptionById($idStage){
            $sql = 'SELECT descriptionStage FROM stage WHERE idStage = :idStage';

            $requete = $this->db->prepare($sql);
            $requete->bindValue('idStage',$idStage);
            $requete->execute();
            $description = $requete->fetchColumn();
            $requete->closeCursor();
            return $description;
         }

         public function getTitreById($idStage){
            $sql = 'SELECT titre FROM stage WHERE idStage = :idStage';

            $requete = $this->db->prepare($sql);
            $requete->bindValue('idStage',$idStage);
            $requete->execute();
            $titre = $requete->fetchColumn();
            $requete->closeCursor();
            return $titre;
         }

         public function getMissionById($idStage){
            $sql = 'SELECT mission FROM stage WHERE idStage = :idStage';

            $requete = $this->db->prepare($sql);
            $requete->bindValue('idStage',$idStage);
            $requete->execute();
            $mission = $requete->fetchColumn();
            $requete->closeCursor();
            return $mission;
         }

         public function getLangueById($idStage){
            $sql = 'SELECT langueRequise FROM stage
                    WHERE idStage = :idStage';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $langueRequise = $requete->fetchColumn();
            $requete->closeCursor();
            return $langueRequise;
         }
         public function getDiplomeById($idStage){
            $sql = 'SELECT idDiplome FROM stage WHERE idStage = :idStage';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $id = $requete->fetchColumn();
            $requete->closeCursor();
            return $id;
         }
         public function getVilleById($idStage){
            $sql = 'SELECT libVille FROM stage s
                    JOIN ville v ON v.idVille = s.idVille
                    WHERE idStage = :idStage';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $ville = $requete->fetchColumn();
            $requete->closeCursor();
            return $ville;
         }
         
         public function getAllDiplome(){
            $array = array();
            $sql = 'SELECT idDiplome, niveauDiplome, libDiplome FROM diplome';
            $requete = $this->db->prepare($sql);
            $requete->execute();
            while ($diplome = $requete->fetch(PDO::FETCH_OBJ)){
                $array[] = new Diplome($diplome);
            }
            return $array;
         }
         public function getStageBySearch($recherche, $nbSemaines, $ville, $niveau){
            $array = array();

            $sql = 'SELECT idStage, dateDebut, nbSemaines, mission,langueRequise, descriptionStage,titre, hebergement, idEntreprise,idDiplome, idVille, etat FROM stage';
            
            if(!empty($recherche) OR $ville != "null" OR $niveau != "null" OR $nbSemaines != "null"){
                $sql = $sql.' WHERE';
            
                //recherche
                if (!empty($recherche)) {
                    $sql = $sql.' MATCH(titre) AGAINST (:recherche) OR MATCH(mission) AGAINST (:recherche) OR MATCH(descriptionStage) AGAINST (:recherche) OR MATCH(langueRequise) AGAINST (:recherche)';
                }

                //ville
                if ($ville != "null" AND !empty($recherche)) {
                   
                    $sql = $sql.' AND idVille = :ville';
                }else{
                    if($ville != "null" AND empty($recherche)){
                       
                        $sql = $sql.' idVille = :ville';
                    }
                }
                

                //niveau
                if ($niveau != "null" AND (!empty($recherche) OR $ville != "null")) {
                    $sql = $sql.' AND idDiplome = :niveau';
                    
                }else{
                    if($niveau != "null" AND empty($recherche) AND $ville == "null"){
                       
                        $sql = $sql.' idDiplome = :niveau';
                    }
                }

                //nbSemaines
                if($nbSemaines != "null" AND (!empty($recherche) OR $ville != "null" OR $niveau != "null")){
                    $sql = $sql.' AND nbSemaines = :nbSemaines';
                    
                }else{
                    if($nbSemaines != "null" AND empty($recherche) AND $ville == "null" AND $niveau == "null"){
                        $sql = $sql.' nbSemaines = :nbSemaines';
                        
                    }
                }
            }
            /*if(empty($recherche)){
                echo 18;
            }*/

            //echo $niveau;
            

            $requete = $this->db->prepare($sql);


            if (!empty($recherche)) {
                $requete->bindValue(':recherche', $recherche);
            }
            if ($ville != "null") {
                $requete->bindValue(':ville', $ville);
            }
            
            if ($niveau != "null") {
                $requete->bindValue(':niveau', $niveau);
            }
            if($nbSemaines != "null"){
                $requete->bindValue(':nbSemaines', $nbSemaines);
            }



            $requete->execute();

            while ($Stage = $requete->fetch(PDO::FETCH_OBJ)){
                $array[] = new Stage($Stage);
            }

            return $array;
         }
        public function getStageById($idStage){
            $array = array();
            $sql = 'SELECT idStage, dateDebut, nbSemaines, mission,langueRequise, descriptionStage,titre, hebergement, idEntreprise,idDiplome, idVille, etat FROM stage WHERE idStage ='.$idStage;
            $requete = $this->db->prepare($sql);
            $requete->execute();
            while ($Stage = $requete->fetch(PDO::FETCH_OBJ)){
                $array[] = new Stage($Stage);
            }
            return $array;

        }       
        public function getDureeById($idStage){
            $sql = 'SELECT nbSemaines FROM stage 
                
                    WHERE idStage = :idStage';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $duree = $requete->fetchColumn();
            $requete->closeCursor();
            return $duree;
        }  

         public function nombreOffresById($idResponsable){
            $nombreOffres = array();
            $sql = 'SELECT * FROM stage s
                    JOIN responsableentreprise r ON r.idEntreprise = s.idEntreprise
                    WHERE idResponsableEnt = :idResponsable';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idResponsable', $idResponsable);
            $requete->execute();
            while($offre = $requete->fetch(PDO::FETCH_OBJ)){
                $nombreOffres[] = new Stage($offre);
            }
            $requete->closeCursor();
            return count($nombreOffres);
         } 

         public function getListOffresById($idResponsable) {
            $offres = array();

            $sql = 'SELECT idStage, mission, descriptionStage, r.idEntreprise, titre, nbSemaines FROM responsableentreprise r 
                    JOIN stage s ON s.idEntreprise = r.idEntreprise WHERE idResponsableEnt = :idResponsable';

            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idResponsable',$idResponsable);
            $requete->execute();

            while ($offre = $requete->fetch(PDO::FETCH_OBJ))
                    $offres[] = new Stage($offre);

            $requete->closeCursor();
            return $offres;
         }

         public function updateStage($idStage, $mission, $langueRequise, $descriptionStage, $titre, $diplome, $ville, $duree){
          
            $sqlUpdate = 'UPDATE stage SET mission = :mission, langueRequise = :langueRequise, descriptionStage = :descriptionStage, titre = :titre, idDiplome = :diplome, idVille = :ville, nbSemaines = :duree where idStage = :idStage';
            $requete2 = $this->db->prepare($sqlUpdate);
            $requete2->bindValue(':idStage', $idStage);
            $requete2->bindValue(':mission', $mission);
            $requete2->bindValue(':langueRequise', $langueRequise);
            $requete2->bindValue(':descriptionStage', $descriptionStage);
            $requete2->bindValue(':titre', $titre);
            $requete2->bindValue(':diplome', $diplome);
            $requete2->bindValue(':ville', $ville);
            $requete2->bindValue(':duree', $duree);
            $requete2->execute();
            $requete2->closeCursor();
         }
		 
		  public function getIdStageByIdEntreprise($idEntreprise){             
			$idstage = array();             
			$sql = 'SELECT idStage FROM stage WHERE idEntreprise = :idEntreprise';             
			$requete = $this->db->prepare($sql);             
			$requete->bindValue('idEntreprise',$idEntreprise);             
			$requete->execute();             
			while($stage = $requete->fetch(PDO::FETCH_OBJ)){
				$idstage[] = new Stage($stage);             
			}             
			return $idstage;         
		  }
		  
		   public function getStagesByVille($idVille){             
			$stages = array();
			$sql = 'SELECT * FROM stage WHERE idVille = :idVille';
			$requete = $this->db->prepare($sql);
			$requete->bindValue('idVille',$idVille);
			$requete->execute();
			while($stage = $requete->fetch(PDO::FETCH_OBJ)){
				$stages[] = new Stage($stage);
			}                         
			return $stages;         
		   }

		   public function validerOffre($idStage){
               $sqlUpdate = 'UPDATE stage SET valide = 1 where idStage = :idStage';
               $requete = $this->db->prepare($sqlUpdate);
               $requete->bindValue(':idStage', $idStage);
               $requete->execute();
               $requete->closeCursor();
           }

        public function getStagesNonOccupesByVille($idVille){
            $stages = array();
            $sql = 'SELECT * FROM stage WHERE idVille = :idVille AND valide = 0';
            $requete = $this->db->prepare($sql);
            $requete->bindValue('idVille',$idVille);
            $requete->execute();
            while($stage = $requete->fetch(PDO::FETCH_OBJ)){
                $stages[] = new Stage($stage);
            }
            return $stages;
        }

        public function getStagesByIdEntreprise($idEntreprise){
            $stages = array();
            $sql = 'SELECT * FROM stage WHERE idEntreprise = :idEntreprise';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idEntreprise',$idEntreprise);
            $requete->execute();
            while($stage = $requete->fetch(PDO::FETCH_OBJ)){
                $stages[] = new Stage($stage);
            }
            return $stages;
        }
        public function getIdEntrepriseById($idStage){
             $sql = 'SELECT idEntreprise FROM stage WHERE idStage = :idStage';
             $requete = $this->db->prepare($sql);
             $requete->bindValue('idStage',$idStage);
             $requete->execute();
             $idEta = $requete->fetchColumn();
             $requete->closeCursor();
             return $idEta;
         }
        public function deleteStages($idEntreprise){
            $sql = 'DELETE FROM stage WHERE idEntreprise = :idEntreprise';

            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idEntreprise', $idEntreprise);
            $requete->execute();
            $requete->closeCursor();
        }

        public function toObject($idStage){
            $sql = 'SELECT * FROM stage WHERE idStage = :idStage';

            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $stage = $requete->fetch(PDO::FETCH_OBJ);
            $stage = new Stage($stage);
            $requete->closeCursor();
            return $stage;
        }
        
        public function getLastId(){
            $sql = 'SELECT idStage FROM stage ORDER BY idStage DESC LIMIT 1';
            
            $requete = $this->db->prepare($sql);
            $requete->execute();
            $lastId = $requete->fetchColumn();
            $requete->closeCursor();
            return $lastId;
        }

    }
?>
