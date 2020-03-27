<?php
	
	class EtablissementManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($etablissement){
            $requete = $this->pdo->prepare(
			     'INSERT INTO etablissement (
                 id_etablissement, nom_etablissement,adr_etablissmement,cp_etablissement,id_ville)VALUES(:idEtablissement, :nomEta, :adresseEta, :cdp, :idVille);'); 

            $requete->bindValue(':idEtablissement',$etablissement->getId_etablissement());
			$requete->bindValue(':nomEta',$etablissement->getNom_etablissement());
            $requete->bindValue(':adresseEta',$etablissement->getAdr_etablissmement());
            $requete->bindValue(':cdp',$etablissement->getCp_etablissement());
            $requete->bindValue(':idVille',$etablissement->getId_ville());

            $retour=$requete->execute();
			return $retour;
         }
         
         public function getNomEtablissementById($id){
             $sql = 'SELECT nomEta FROM etablissement WHERE idEtablissement = :idEtablissement';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue('idEtablissement',$id);
             $requete->execute();
             $nomEta = $requete->fetchColumn();
             $requete->closeCursor();
             return $nomEta;
         }
         
         public function getListDesAutresEtablissements($id) {
             $listeEtablissements = array();
             
             $sql = 'SELECT * FROM etablissement WHERE idEtablissement != :idEtablissement';
             
             $requete = $this->pdo->prepare($sql);
             $requete->bindValue(':idEtablissement',$id);
             $requete->execute();
             
             while ($etablissement = $requete->fetch(PDO::FETCH_OBJ))
                 $listeEtablissements[] = new Etablissement($etablissement);
                 
                 $requete->closeCursor();
                 return $listeEtablissements;
    }
    
    public function getIdVilleByIdEtablissement($idEta){
        $sql = 'SELECT idVille FROM etablissement WHERE idEtablissement = :idEtablissement';
        
        $requete = $this->pdo->prepare($sql);
        $requete->bindValue('idEtablissement',$idEta);
        $requete->execute();
        $idVille = $requete->fetchColumn();
        $requete->closeCursor();
        return $idVille;
    }
    
    public function getListEtablissements() {
             $listeEtablissements = array();
             
             $sql = 'SELECT * FROM etablissement';
             
             $requete = $this->pdo->prepare($sql);
             $requete->execute();
             
             while ($etablissement = $requete->fetch(PDO::FETCH_OBJ))
                 $listeEtablissements[] = new Etablissement($etablissement);
                 
                 $requete->closeCursor();
                 return $listeEtablissements;
    }
}
?>