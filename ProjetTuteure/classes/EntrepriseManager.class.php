<?php
	
	class EntrepriseManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($entreprise){
            $requete = $this->pdo->prepare(
			     'INSERT INTO entreprise (
                 id_entreprise, nom_entreprise,mail_entreprise,siren_entreprise,num_entreprise,adr_entreprise,cp_entreprise,id_ville)VALUES(:idEntreprise, :nomEntreprise, :mailEntreprise, :numSiren, :telEntreprise, :adresseEta, :cdp, :idVille);'); 

            $requete->bindValue(':idEntreprise',$entreprise->getId_entreprise());
			$requete->bindValue(':nomEntreprise',$entreprise->getNom_entreprise());
            $requete->bindValue(':mailEntreprise',$entreprise->getMail_entreprise());
            $requete->bindValue(':numSiren',$entreprise->getSiren_entreprise());
            $requete->bindValue(':telEntreprise',$entreprise->getNum_entreprise());
            $requete->bindValue(':adresseEta',$entreprise->getAdr_entreprise());
            $requete->bindValue(':cdp',$entreprise->getCp_entreprise());
            $requete->bindValue(':idVille',$entreprise->getId_ville());

            $retour=$requete->execute();
			return $retour;
         }
         public function getNomEntById($idEnt){
            $sql = 'SELECT nomEntreprise FROM entreprise WHERE idEntreprise = :idEnt';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue('idEnt',$idEnt);
            $requete->execute();
            $name = $requete->fetchColumn();
            $requete->closeCursor();
            return $name;
        }
        
        public function getIdEntrepriseById($idPersonne){
            $sql = 'SELECT e.idEntreprise FROM entreprise e
                    JOIN responsableentreprise r ON r.idEntreprise = e.idEntreprise
                    WHERE idResponsableEnt = :idPersonne';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idPersonne', $idPersonne);
            $requete->execute();
            $id = $requete->fetchColumn();
            $requete->closeCursor();
            return $id;
        }
        
        public function toObject($idEntreprise) {
            $sql = 'SELECT * FROM entreprise WHERE idEntreprise = :idEntreprise';
            
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idEntreprise',$idEntreprise);
            $requete->execute();
            $entreprise = $requete->fetch(PDO::FETCH_OBJ);
            $entreprise = new Entreprise($entreprise);
            $requete->closeCursor();
            return $entreprise;
        }
        
        public function modifEntreprise($nom,$mail,$siren,$tel,$adresse,$cdp,$idVille,$idEntreprise){
            $sqlUpdate = 'UPDATE entreprise SET nomEntreprise = :nom, mailEntreprise = :mail, numSiren = :siren, telEntreprise = :tel, adresseEta = :adresse, cdp = :cdp, idVille = :idVille WHERE idEntreprise = :idEntreprise';
            $requete = $this->pdo->prepare($sqlUpdate);
            $requete->bindValue(':nom',$nom);
            $requete->bindValue(':mail',$mail);
            $requete->bindValue(':siren',$siren);
            $requete->bindValue(':tel',$tel);
            $requete->bindValue(':adresse',$adresse);
            $requete->bindValue(':cdp',$cdp);
            $requete->bindValue(':idVille',$idVille);
            $requete->bindValue(':idEntreprise',$idEntreprise);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function getAdresseEntById($idEnt){
            $sql = 'SELECT adresseEta FROM entreprise WHERE idEntreprise = :idEnt';
            $requete = $this->pdo->prepare($sql);
            $requete->bindValue('idEnt',$idEnt);
            $requete->execute();
            $adr = $requete->fetchColumn();
            $requete->closeCursor();
            return $adr;
        }
        
        public function verifMailEnt($mail){
            $sql = 'SELECT mailEntreprise FROM entreprise WHERE mailEntreprise = :mail AND mailEntreprise IN (SELECT mailEntreprise FROM entreprise)';

            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':mail',$mail);
            $requete->execute();
            $bool = $requete->fetchColumn();
            if(!empty($bool)){
                return true;
            }else{
                return false;
            }
        }

        public function inscriptionEnt($nom,$adresse,$telephone,$mailEntreprise,$siren,$cdp,$idVille){
            $sql = 'INSERT INTO entreprise(nomEntreprise,mailEntreprise,numSiren,telEntreprise,adresseEta,cdp,idVille) VALUES (:nom, :mail, :siren, :telephone, :adresse, :cdp, :idVille)';

            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':nom',$nom);
            $requete->bindValue(':mail',$mailEntreprise);
            $requete->bindValue(':siren',$siren);
            $requete->bindValue(':telephone',$telephone);
            $requete->bindValue(':adresse',$adresse);
            $requete->bindValue(':cdp',$cdp);
            $requete->bindValue(':idVille',$idVille);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function getIdEntrepriseByNom($nom){
            $sql = 'SELECT idEntreprise FROM entreprise WHERE nomEntreprise = :nom';

            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':nom',$nom);
            $requete->execute();
            $id = $requete->fetchColumn();
            $requete->closeCursor();

            return $id;
        }

        public function deleteEntreprise($idEntreprise){
            $sql = 'DELETE FROM entreprise WHERE idEntreprise = :idEntreprise';

            $requete = $this->pdo->prepare($sql);
            $requete->bindValue(':idEntreprise', $idEntreprise);
            $requete->execute();
            $requete->closeCursor();
        }

        public function getIdEntrepriseByLogin($login){
    		    $sql='SELECT idEntreprise FROM responsableentreprise r JOIN personne p on r.idResponsableEnt=p.idPersonne AND p.persMail= :login';
    		    $requete = $this->pdo->prepare($sql);
    		    $requete->bindValue(':login',$login);
    		    $requete->execute();
    		    $id = $requete->fetchColumn();
    		    $requete->closeCursor();

    		    return $id;
        }

        public function getListEntreprises() {
            $listeEntreprises = array();

            $sql = 'SELECT nomEntreprise FROM Entreprise';

            $requete = $this->pdo->prepare($sql);
            $requete->execute();

            while ($entreprise = $requete->fetch(PDO::FETCH_OBJ))
                $listeEntreprises[] = new Entreprise($entreprise);

            $requete->closeCursor();
            return $listeEntreprises;
        }
    }
?>