<?php
    class PersonneManager{
    	
        private $dbo;

    		public function __construct($db){
    			$this->db = $db;
    		}

        public function add($personne){
            $requete = $this->pdo->prepare(
			     'INSERT INTO personne (
                 idPersonne,nom,prenom,telephone,administrateur,persMail,
                 passwd,naissance)VALUES(:idPersonne, :nom,:prenom,:telephone,:administrateur,:persMail,:passwd,:naissance);'); 

            $requete->bindValue(':idPersonne',$personne->getId_personne());
			$requete->bindValue(':nom',$personne->getNom_personne());
            $requete->bindValue(':prenom',$personne->getPrenom_personne());
            $requete->bindValue(':telephone',$personne->getNum_personne());
            $requete->bindValue(':administrateur',$personne->getAdmin());
            $requete->bindValue(':persMail',$personne->getMail_personne());
            $requete->bindValue(':passwd',$personne->getMdp_personne());
            $requete->bindValue(':naissance',$personne->getDate_naissance_personne());

            $retour=$requete->execute();
			return $retour;
        }

        public function testPersonne($mailPersonne){
            $estPersonne = array();

            $sql = 'SELECT * FROM personne WHERE persMail = :persMail';

            $requete = $this->db->prepare($sql);
            $requete->bindValue(':persMail',$mailPersonne);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                $estPersonne[] = new Personne($personne);

            $requete->closeCursor();
            return count($estPersonne);
        }


        public function testPersonneLog($mailPersonne){
            $estPersonne = array();

            $sql = 'SELECT * FROM personne WHERE persMail = :persMail';

            $requete = $this->db->prepare($sql);
            $requete->bindValue('persMail',$mailPersonne);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                    $estPersonne[] = new Personne($personne);

            $requete->closeCursor();
            return $estPersonne;
        }

        public function testPersonneEtudiant($persMail){
            $estPersonne = array();

            $sql = 'SELECT * FROM etudiant e JOIN personne p ON p.idPersonne = e.idEtudiant WHERE idPersonne = idEtudiant AND persMail = :persMail';

            $requete = $this->db->prepare($sql);
            $requete->bindValue('persMail',$persMail);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                    $estPersonne[] = new Personne($personne);

            $requete->closeCursor();

            return count($estPersonne);
        }

        public function testPersonneEntreprise($persMail){
            $estPersonne = array();

            $sql = 'SELECT * FROM responsableentreprise r JOIN personne p ON p.idPersonne = r.idResponsableEnt WHERE idPersonne = idResponsableEnt AND persMail = :persMail';

            $requete = $this->db->prepare($sql);
            $requete->bindValue('persMail',$persMail);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                    $estPersonne[] = new Personne($personne);

            $requete->closeCursor();

            return count($estPersonne);
        }

        public function testPersonneResponsable($persMail){
            $estPersonne = array();

            $sql = 'SELECT * FROM responsableetudiant re JOIN personne p ON p.idPersonne = re.idResponsable WHERE idPersonne = idResponsable AND persMail = :persMail';

            $requete = $this->db->prepare($sql);
            $requete->bindValue('persMail',$persMail);
            $requete->execute();

            while ($personne = $requete->fetch(PDO::FETCH_OBJ))
                    $estPersonne[] = new Personne($personne);

            $requete->closeCursor();

            return count($estPersonne);
        }
        
        public function getIdByLogin($login){
            $sql = 'SELECT idPersonne FROM personne WHERE persMail = :persMail';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('persMail',$login);
            $requete->execute();
            $id = $requete->fetchColumn();
            $requete->closeCursor();
            return $id;
        }
        
        public function getNomByLogin($login){
            $sql = 'SELECT nom FROM personne WHERE persMail = :persMail';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('persMail',$login);
            $requete->execute();
            $nom = $requete->fetchColumn();
            $requete->closeCursor();
            return $nom;
        }
        
        public function getPrenomByLogin($login){
            $sql = 'SELECT prenom FROM personne WHERE persMail = :persMail';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('persMail',$login);
            $requete->execute();
            $prenom = $requete->fetchColumn();
            $requete->closeCursor();
            return $prenom;
        }
        
        public function getTelephoneByLogin($login){
            $sql = 'SELECT telephone FROM personne WHERE persMail = :persMail';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('persMail',$login);
            $requete->execute();
            $telephone = $requete->fetchColumn();
            $requete->closeCursor();
            return $telephone;
        }
        
        public function modifPersonne($id,$nom,$prenom,$tel,$mail){
            $sqlUpdate = 'UPDATE personne SET nom = :nom, prenom = :prenom, telephone = :telephone, persMail = :persMail WHERE idPersonne = :idPersonne';
            $requete = $this->db->prepare($sqlUpdate);
            $requete->bindValue(':idPersonne',$id);
            $requete->bindValue(':nom',$nom);
            $requete->bindValue(':prenom',$prenom);
            $requete->bindValue(':telephone',$tel);
            $requete->bindValue(':persMail',$mail);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function getPrenomById($id){
            $sql = 'SELECT prenom FROM personne WHERE idPersonne = :idEtudiant';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('idEtudiant',$id);
            $requete->execute();
            $prenom = $requete->fetchColumn();
            $requete->closeCursor();
            return $prenom;
        }
        
        public function getNomById($id){
            $sql = 'SELECT nom FROM personne WHERE idPersonne = :idEtudiant';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('idEtudiant',$id);
            $requete->execute();
            $nom = $requete->fetchColumn();
            $requete->closeCursor();
            return $nom;
        }
        
        public function modifPersonneMdp($id,$nom,$prenom,$tel,$mail,$mdp){
            $sqlUpdate = 'UPDATE personne SET nom = :nom, prenom = :prenom, telephone = :telephone, persMail = :persMail, passwd = :mdp WHERE idPersonne = :idPersonne';
            $requete = $this->db->prepare($sqlUpdate);
            $requete->bindValue(':idPersonne',$id);
            $requete->bindValue(':nom',$nom);
            $requete->bindValue(':prenom',$prenom);
            $requete->bindValue(':telephone',$tel);
            $requete->bindValue(':persMail',$mail);
            $requete->bindValue(':mdp',$mdp);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function verifMail($mail){
            $sql = 'SELECT persMail FROM personne WHERE persMail = :mail AND persMail IN (SELECT persMail FROM personne)';

            $requete = $this->db->prepare($sql);
            $requete->bindValue(':mail',$mail);
            $requete->execute();
            $bool = $requete->fetchColumn();
            if(!empty($bool)){
                return true;
            }else{
                return false;
            }
        }
        
        public function inscriptionEtu($nom,$prenom,$telephone,$persMail,$mdp,$naissance){
            $sql = 'INSERT INTO personne(nom,prenom,telephone,administrateur,persMail,passwd,naissance) VALUES (:nom, :prenom, :telephone, :administrateur, :persMail, :mdp, :naissance)';

            $requete = $this->db->prepare($sql);
            $requete->bindValue(':nom',$nom);
            $requete->bindValue(':prenom',$prenom);
            $requete->bindValue(':telephone',$telephone);
            $requete->bindValue(':administrateur',0);
            $requete->bindValue(':persMail',$persMail);
            $requete->bindValue(':mdp',$mdp);
            $requete->bindValue(':naissance',$naissance);
            $requete->execute();
            $requete->closeCursor();
        }
        
        public function inscriptionRes($nom,$prenom,$telephone,$persMail,$mdp,$naissance){
            $sql = 'INSERT INTO personne(nom,prenom,telephone,administrateur,persMail,passwd,naissance) VALUES (:nom, :prenom, :telephone, :administrateur, :persMail, :mdp, :naissance)';

            $requete = $this->db->prepare($sql);
            $requete->bindValue(':nom',$nom);
            $requete->bindValue(':prenom',$prenom);
            $requete->bindValue(':telephone',$telephone);
            $requete->bindValue(':administrateur',0);
            $requete->bindValue(':persMail',$persMail);
            $requete->bindValue(':mdp',$mdp);
            $requete->bindValue(':naissance',$naissance);
            $requete->execute();
            $requete->closeCursor();
        }

        public function inscriptionResEnt($nom,$prenom,$telephone,$persMail,$mdp,$naissance){
            $sql = 'INSERT INTO personne(nom,prenom,telephone,administrateur,persMail,passwd,naissance) VALUES (:nom, :prenom, :telephone, :administrateur, :persMail, :mdp, :naissance)';

            $requete = $this->db->prepare($sql);
            $requete->bindValue(':nom',$nom);
            $requete->bindValue(':prenom',$prenom);
            $requete->bindValue(':telephone',$telephone);
            $requete->bindValue(':administrateur',0);
            $requete->bindValue(':persMail',$persMail);
            $requete->bindValue(':mdp',$mdp);
            $requete->bindValue(':naissance',$naissance);
            $requete->execute();
            $requete->closeCursor();
        }

        public function deletePersonne($idPersonne){
            $sql = 'DELETE FROM personne WHERE idPersonne = :idPersonne';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':idPersonne', $idPersonne);
            $requete->execute();
            $requete->closeCursor();
        }

        public function getNaissanceByLogin($login){
            $sql = 'SELECT naissance FROM personne
                    WHERE persMail = :login';
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':login',$login);
            $requete->execute();
            $naissance = $requete->fetchColumn();
            $requete->closeCursor();
            return $naissance;
        }
        
        public function testAdmin($login){
            $estAdmin = array();
            
            $sql = 'SELECT * FROM personne WHERE persMail = :login AND administrateur = 1 ';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue(':login',$login);
            $requete->execute();
            
            while ($admin = $requete->fetch(PDO::FETCH_OBJ))
                $estAdmin[] = new ResponsableEtudiant($admin);
                
                $requete->closeCursor();
                
                return count($estAdmin);
        }
        
        public function getMailById($id){
            $sql = 'SELECT persMail FROM personne WHERE idPersonne = :idEtudiant';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('idEtudiant',$id);
            $requete->execute();
            $mail = $requete->fetchColumn();
            $requete->closeCursor();
            return $mail;
        }
        
        public function getNaissanceById($id){
            $sql = 'SELECT naissance FROM personne WHERE idPersonne = :idEtudiant';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('idEtudiant',$id);
            $requete->execute();
            $naissance = $requete->fetchColumn();
            $requete->closeCursor();
            return $naissance;
        }
        
        public function getTelephoneById($id){
            $sql = 'SELECT telephone FROM personne WHERE idPersonne = :idEtudiant';
            
            $requete = $this->db->prepare($sql);
            $requete->bindValue('idEtudiant',$id);
            $requete->execute();
            $tel = $requete->fetchColumn();
            $requete->closeCursor();
            return $tel;
        }
    }
?>