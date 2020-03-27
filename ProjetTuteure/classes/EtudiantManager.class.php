<?php
	
	class EtudiantManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($etudiant){
            $requete = $this->pdo->prepare(
			     'INSERT INTO etudiant (
                 id_etudiant, id_etablissement)VALUES(:idEtudiant, :idEtablissement);'); 

            $requete->bindValue(':idEtudiant',$etudiant->getId_etudiant());
			$requete->bindValue(':idEtablissement',$etudiant->getId_etablissement());

            $retour=$requete->execute();
			return $retour;
         }
    
    public function getIdEtablissementByIdEtudiant($login){
        $sql = 'SELECT idEtablissement FROM etudiant WHERE idEtudiant = :idPersonne';
        
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue('idPersonne',$login);
        $requete->execute();
        $id = $requete->fetchColumn();
        $requete->closeCursor();
        return $id;
    }
    
    public function modifEtudiant($id,$idEtablissement){
        $sqlUpdate = 'UPDATE etudiant SET idEtablissement = :idEtablissement WHERE idEtudiant = :idEtudiant';
        $requete = $this->pdo->prepare($sqlUpdate);
        $requete->bindValue(':idEtudiant',$id);
        $requete->bindValue(':idEtablissement',$idEtablissement);
        $requete->execute();
        $requete->closeCursor();
    }

    
    public function getListeMesEtudiants($idEtablissement){
        $listeEtudiants = array();
        
        $sql = 'SELECT * FROM etudiant WHERE idEtablissement = :idEtablissement';
        
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(':idEtablissement',$idEtablissement);
        $requete->execute();
        
        while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
            $listeEtudiants[] = new Etudiant($etudiant);
            
            $requete->closeCursor();
            return $listeEtudiants;
    }
    
    public function insertEtu($idEtudiant,$idEtablissement){
        $sql = 'INSERT INTO etudiant(idEtudiant, idEtablissement) VALUES (:idEtudiant, :idEtablissement)';


        $requete = $this->pdo->prepare($sql);
        $requete->bindValue(':idEtudiant', $idEtudiant);
        $requete->bindValue(':idEtablissement', $idEtablissement);
        $requete->execute();
        $requete->closeCursor();
    }

        public function deleteEtudiant($idEtudiant){
            $sql = 'DELETE FROM etudiant WHERE idEtudiant = :idEtudiant';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idEtudiant', $idEtudiant);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function getListeMesEtudiantsNonMasques($idEtablissement){
            $listeEtudiants = array();
            
            $sql = 'SELECT * FROM etudiant WHERE idEtablissement = :idEtablissement AND idEtudiant NOT IN (SELECT * from masqueretudiant)';
            
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idEtablissement',$idEtablissement);
            $requete->execute();
            
            while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
                $listeEtudiants[] = new Etudiant($etudiant);
                
                $requete->closeCursor();
                return $listeEtudiants;
        }
        
        public function getListeMesEtudiantsMasques($idEtablissement){
            $listeEtudiants = array();
            
            $sql = 'SELECT * FROM etudiant WHERE idEtablissement = :idEtablissement AND idEtudiant IN (SELECT * from masqueretudiant)';
            
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idEtablissement',$idEtablissement);
            $requete->execute();
            
            while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
                $listeEtudiants[] = new Etudiant($etudiant);
                
                $requete->closeCursor();
                return $listeEtudiants;
        }
}
?>