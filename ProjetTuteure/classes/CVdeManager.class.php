<?php
	
	class CVdeManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($cvde){
            $requete = $this->pdo->prepare(
			     'INSERT INTO cvde (
                 idCv, idEtudiant)VALUES(:idCV, :idEtudiant);'); 

            $requete->bindValue(':idCV',$cvde->getId_cv());
			$requete->bindValue(':idEtudiant',$cvde->getId_etudiant());

            $retour=$requete->execute();
			return $retour;
         }
         
         public function getListCvde($idPersonne){
             $listeCV = array();
             
             $sql = 'SELECT * FROM cvde WHERE idEtudiant = :id_etudiant';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':id_etudiant',$idPersonne);
             $requete->execute();
             
             while ($cvde = $requete->fetch(PDO::FETCH_OBJ))
                 $listeCV[] = new CVde($cvde);
                 
                 $requete->closeCursor();
                 return $listeCV;
         }
         
         public function nbCV($idPersonne){
             $listeCV = array();
             
             $sql = 'SELECT * FROM cvde WHERE idEtudiant = :id_etudiant';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':id_etudiant',$idPersonne);
             $requete->execute();
             
             while ($cvde = $requete->fetch(PDO::FETCH_OBJ))
                 $listeCV[] = new CVde($cvde);
                 
                 $requete->closeCursor();
                 return count($listeCV);
         }
         
         public function supprimerCVde($id){
             $sql = 'DELETE FROM cvde WHERE idCV = :idCv';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':idCv',$id);
             $requete->execute();
             $requete->closeCursor();
             
         }

        public function deleteCvde($idEtudiant){
            $sql = 'DELETE FROM cvde WHERE idEtudiant = :idEtudiant';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idEtudiant', $idEtudiant);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function ajouterCvDe($idPersonne){
            $sql = 'INSERT INTO cvde (
                 idCv, idEtudiant)VALUES(:idCv, :idEtudiant);';
            $id = $this->getLastId() + 1 ;
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idEtudiant',$idPersonne);
            $requete->bindValue(':idCv',$id);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function getLastId(){
            $sql = 'SELECT idCv FROM cvde ORDER BY idCv DESC LIMIT 1';
            $requete = $this->pdo->prepare($sql);
            $requete->execute();
            $id = $requete->fetchColumn();
            $requete->closeCursor();
            return $id;
        }
    }
?>