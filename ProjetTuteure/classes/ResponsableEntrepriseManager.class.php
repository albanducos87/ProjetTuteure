<?php
	
	class ResponsableEntrepriseManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($responsableEntreprise){
            $requete = $this->pdo->prepare(
			     'INSERT INTO responsableEntreprise (
                 id_responsable, id_entreprise)VALUES(:idResponsable, :idEntreprise);'); 

            $requete->bindValue(':idResponsable',$responsableEntreprise->getId_responsable());
			$requete->bindValue(':idEntreprise',$responsableEntreprise->getId_entreprise());

            $retour=$requete->execute();
			return $retour;
         }
          public function getEntrepriseById($idResponsable){
            $requete = $this->pdo->prepare(
                'SELECT e.idEntreprise, mailEntreprise, numSiren, telEntreprise, adresseEta, cdp, idVille, idResponsableEnt FROM entreprise e 
                JOIN responsableentreprise r ON r.idEntreprise = e.idEntreprise WHERE idResponsableEnt = :idResponsableEnt');
            $requete->bindValue(':idResponsableEnt', $idResponsable);
            $retour = $requete->execute();
            $entreprise = $requete->fetch(PDO::FETCH_OBJ);
            $requete->closeCursor();
            $MonEntreprise = new Entreprise($entreprise);
            return $MonEntreprise;
         }
         
         public function insertResponsable($idResponsableEnt, $idEntreprise){
            $sql = 'INSERT INTO responsableentreprise VALUES (:idResponsableEnt, :idEntreprise)';

            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idResponsableEnt',$idResponsableEnt);
            $requete->bindValue(':idEntreprise',$idEntreprise);
            $requete->execute();
            $requete->closeCursor();
         }

        public function deleteResponsableEntreprise($idResponsable){
            $sql = 'DELETE FROM responsableentreprise WHERE idResponsableEnt = :idResponsable';

            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idResponsable', $idResponsable);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function getListeResponsableEntrepriseNonMasques(){
            $listeRespEnt = array();
            
            $sql = 'SELECT * FROM responsableentreprise WHERE idResponsableEnt NOT IN (SELECT * from masquerresponsableentreprise)';
            
            $requete = $this->pdo->prepare($sql);
            $requete->execute();
            
            while ($respEnt = $requete->fetch(PDO::FETCH_OBJ))
                $listeRespEnt[] = new ResponsableEntreprise($respEnt);
                
                $requete->closeCursor();
                return $listeRespEnt;
        }
        
        public function getListeResponsableEntrepriseMasques(){
            $listeRespEnt = array();
            
            $sql = 'SELECT * FROM responsableentreprise WHERE idResponsableEnt IN (SELECT * from masquerresponsableentreprise)';
            
            $requete = $this->pdo->prepare($sql);
            $requete->execute();
            
            while ($respEnt = $requete->fetch(PDO::FETCH_OBJ))
                $listeRespEnt[] = new ResponsableEntreprise($respEnt);
                
                $requete->closeCursor();
                return $listeRespEnt;
        }
    }
?>