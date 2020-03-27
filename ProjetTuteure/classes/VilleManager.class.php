<?php
    
    class VilleManager{
        private $pdo;

            public function __construct($pdo){
                $this->pdo = $pdo;
            }

        public function add($personne){
            $requete = $this->pdo->prepare(
                 'INSERT INTO ville (
                 id_ville,nom_ville,id_pays)VALUES(:idVille, :libVille, :idPays);'); 

            $requete->bindValue(':idVille',$personne->getId_ville());
            $requete->bindValue(':libVille',$personne->getNom_ville());
            $requete->bindValue(':idPays',$personne->getId_pays());

            $retour=$requete->execute();
            return $retour;
        }
        public function getAllVilles(){
        $listeVilles = array();
        $sql ='SELECT idVille, libVille, idPays FROM ville';
        $requete = $this->pdo->prepare($sql);
        $requete->execute();     
        while ($ville = $requete->fetch(PDO::FETCH_OBJ)){
            $listeVilles[] = new ville ($ville);
        }
            return $listeVilles;
            $requete->closeCursor();
        }
        public function getVilleByID($idVille){
            $sql ='SELECT libVille FROM ville WHERE idVille='.$idVille;
            $requete = $this->pdo->prepare($sql);
            $requete->execute();
            $ville = $requete->fetchColumn();
            $requete->closeCursor();
            return $ville;
        }
        public function getVilleByIdStage($idStage){
            $sql = 'SELECT libVille FROM ville v
                    JOIN stage s ON s.idVille = v.idVille
                    WHERE idStage = :idStage';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $ville = $requete->fetchColumn();
            $requete->closeCursor();
            return $ville;
        }
        public function getIdByVille($libVille){
            $sql ='SELECT idVille FROM ville WHERE libVille= :libVille';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':libVille', $libVille);
            $requete->execute();
            $ville = $requete->fetchColumn();
            $requete->closeCursor();
            return $ville;
        }
        public function getIdVilleByIdStage($idStage){
            $sql = 'SELECT v.idVille FROM ville v
                    JOIN stage s ON s.idVille = v.idVille
                    WHERE idStage = :idStage';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idStage', $idStage);
            $requete->execute();
            $ville = $requete->fetchColumn();
            $requete->closeCursor();
            return $ville;
        }
         public function getListDesAutresVilles($id) {
             $listeVilles = array();
             
             $sql = 'SELECT DISTINCT * FROM ville WHERE idVille != :idVille';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':idVille',$id);
             $requete->execute();
             
             while ($ville = $requete->fetch(PDO::FETCH_OBJ))
                 $listeVilles[] = new Ville($ville);
                 
                 $requete->closeCursor();
                 return $listeVilles;
                     
         }
         
          public function getListDesVilles(){
            $listeVilles = array();

            $sql = 'SELECT DISTINCT libVille FROM ville';

            $requete = $this->pdo->prepare($sql);
            $requete->execute();

            while($ville = $requete->fetch(PDO::FETCH_OBJ)){
                $listeVilles[] = new Ville($ville);
            }

            $requete->closeCursor();
            return $listeVilles;
         }
    }
?>