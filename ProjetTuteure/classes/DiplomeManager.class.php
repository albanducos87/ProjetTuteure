<?php
    
    class DiplomeManager{
        private $pdo;

            public function __construct($pdo){
                $this->pdo = $pdo;
            }

        public function add($diplome){
            $requete = $this->pdo->prepare(
                 'INSERT INTO diplome (
                 id_diplome, niveau_diplome,lib_diplome)VALUES(:idDiplome, :niveauDiplome, :libDiplome);'); 
            $requete->bindValue(':idDiplome',$diplome->getId_diplome());
            $requete->bindValue(':niveauDiplome',$diplome->getNiveau_diplome());
            $requete->bindValue(':libDiplome',$diplome->getLib_diplome());

            $retour=$requete->execute();
            return $retour;
         }
          
         public function getDiplomeById($id){
             $sql = 'SELECT * FROM diplome WHERE idDiplome = :idDiplome';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':idDiplome',$id);
             $requete->execute();
             $diplome = $requete->fetch(PDO::FETCH_OBJ);
             $requete->closeCursor();
             $diplome = new Diplome($diplome);
             return $diplome;
         }
         
         public function getListDesAutresDiplomes($id) {
             $listeDiplomes = array();
             
             $sql = 'SELECT DISTINCT * FROM diplome WHERE idDiplome != :idDiplome';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':idDiplome',$id);
             $requete->execute();
             
             while ($diplome = $requete->fetch(PDO::FETCH_OBJ))
                 $listeDiplomes[] = new Diplome($diplome);
                 
                 $requete->closeCursor();
                 return $listeDiplomes;
                     
         }
         public function getAllDiplomes() {
             $listeDiplomes = array();
             
             $sql = 'SELECT DISTINCT * FROM diplome';
             
             $requete = $this->pdo->prepare($sql);
            
             $requete->execute();
             
            while ($diplome = $requete->fetch(PDO::FETCH_OBJ)){
                $listeDiplomes[] = new Diplome($diplome);
            }
                 $requete->closeCursor();
                 return $listeDiplomes;
                     
         }
         public function getAllNomDiplomes() {
             $listeNomDiplomes = array();
             
             $sql = 'SELECT DISTINCT libDiplome FROM diplome';
             
             $requete = $this->pdo->prepare($sql);
            
             $requete->execute();
                 
            while ($nomDiplome = $requete->fetch(PDO::FETCH_ASSOC)){
                $listeNomDiplomes[] = $nomDiplome;
            }
                 $requete->closeCursor();
                 return $listeNomDiplomes;
         }


         public function getIdByDiplomeNiveau($niveau,$libDiplome){
            $sql ='select idDiplome from diplome where libDiplome= :libDiplome and niveauDiplome= :niveauDiplome ';
            $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':libDiplome', $libDiplome);
             $requete->bindValue(':niveauDiplome',$niveau);
            $requete->execute();
             $idDiplome = $requete->fetchColumn();
            $requete->closeCursor();
            return $idDiplome;

         }
         public function getIdByLib($libDiplome){
            $sql ='SELECT idDiplome FROM diplome WHERE libDiplome = :libDiplome';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':libDiplome', $libDiplome);
            $requete->execute();
            $idDiplome = $requete->fetchColumn();
            $requete->closeCursor();
            return $idDiplome;

         }
         public function getNomDiplomeById($idDiplome){
            $sql ='SELECT libDiplome FROM diplome WHERE idDiplome='.$idDiplome;
            $requete = $this->pdo->prepare($sql);
            $requete->execute();
            $diplome = $requete->fetchColumn();
            $requete->closeCursor();
            return $diplome;
        }
        public function getNiveauDiplomeById($idDiplome){
            $sql ='SELECT niveauDiplome FROM diplome WHERE idDiplome='.$idDiplome;
            $requete = $this->pdo->prepare($sql);
            $requete->execute();
            $diplome = $requete->fetchColumn();
            $requete->closeCursor();
            return $diplome;
        }

        public function getNomDiplomes() {
            $listeDiplomes = array();
            
            $sql = 'SELECT * FROM diplome GROUP BY libDiplome';
            
            $requete = $this->pdo->prepare($sql);
            
            $requete->execute();
            
            while ($diplome = $requete->fetch(PDO::FETCH_OBJ)){
                $listeDiplomes[] = new Diplome($diplome);
            }
            $requete->closeCursor();
            return $listeDiplomes;
        }
        
        public function getListDesAutresDiplomesDistinct($libDiplome) {
            $listeDiplomes = array();
            
            $sql = 'SELECT * FROM diplome WHERE libDiplome != :libDiplome GROUP BY libDiplome';
            
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':libDiplome',$libDiplome);
            $requete->execute();
            
            while ($diplome = $requete->fetch(PDO::FETCH_OBJ))
                $listeDiplomes[] = new Diplome($diplome);
                
                $requete->closeCursor();
                return $listeDiplomes;
                
        }
        
}