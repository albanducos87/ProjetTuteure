<?php
	
	class CVManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($cv){
            $requete = $this->pdo->prepare(
			     'INSERT INTO CV (
                 idCV, langue,idDiplome,description)VALUES(:idCV, :langue, :idDiplome, :description);'); 

            $requete->bindValue(':idCV',$cv->getId_cv());
			$requete->bindValue(':langue',$cv->getLangue());
            $requete->bindValue(':idDiplome',$cv->getId_diplome());
            $requete->bindValue(':idDiplome',$cv->getDescription());

            $retour=$requete->execute();
			return $retour;
         }
         
         public function getCVById($id){
             $sql = 'SELECT * FROM cv WHERE idCV = :idCv';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':idCv',$id);
             $requete->execute();
             $cv = $requete->fetch(PDO::FETCH_OBJ);
             $requete->closeCursor();
             $cv = new CV($cv);
             return $cv;
         }
         
         public function updateCV($id,$langue,$niveau,$domaine,$description){
             $sqlIdDiplome = 'SELECT idDiplome FROM diplome WHERE niveauDiplome = :niveauDiplome AND libDiplome = :libDiplome';
             $requete = $this->pdo->prepare($sqlIdDiplome);
             $requete->bindValue(':niveauDiplome',$niveau);
             $requete->bindValue(':libDiplome',$domaine);
             $requete->execute();
             $idDiplome = $requete->fetchColumn();
             $requete->closeCursor();
             
             $sqlUpdate = 'UPDATE cv SET idDiplome = :idDiplome, langue = :langue, description = :description WHERE idCV = :idCV ';
             $requete2 = $this->pdo->prepare($sqlUpdate);
             $requete2->bindValue(':idDiplome',$idDiplome);
             $requete2->bindValue(':langue',$langue);
             $requete2->bindValue(':description',$description);
             $requete2->bindValue(':idCV',$id);
             $requete2->execute();
             $requete2->closeCursor();
         }
         
         public function supprimerCV($id){
             $sql = 'DELETE FROM cv WHERE idCV = :idCv';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':idCv',$id);
             $requete->execute();
             $requete->closeCursor();
         }
         
         public function ajouterCV($langue,$idDiplome,$description){
             $sql = 'INSERT INTO CV (
                 idCV, langue,idDiplome,description)VALUES(:idCv, :langue, :idDiplome, :description)';
             $id = $this->getLastId() + 1;
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':langue',$langue);
             $requete->bindValue(':idDiplome',$idDiplome);
             $requete->bindValue(':description',$description);
             $requete->bindValue(':idCv',$id);
             $requete->execute();
             $requete->closeCursor();
         }
         
         public function getLastId(){
             $sql = 'SELECT idCv FROM cv ORDER BY idCv DESC LIMIT 1';
             $requete = $this->pdo->prepare($sql);
             $requete->execute();
             $id = $requete->fetchColumn();
             $requete->closeCursor();
             return $id;
         }
    }
?>