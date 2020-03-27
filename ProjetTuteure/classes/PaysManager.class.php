<?php
	
	class PaysManager{
    	private $pdo;

    		public function __construct($pdo){
    			$this->pdo = $pdo;
    		}

        public function add($pays){
            $requete = $this->pdo->prepare(
			     'INSERT INTO pays (
                 id_pays, nom_pays)VALUES(:idPays, :libPays);'); 

            $requete->bindValue(':idPays',$pays->getId_pays());
			$requete->bindValue(':pernom',$pays->getNom_pays());

            $retour=$requete->execute();
			return $retour;
         }

         public function getAllPays(){
             $listePays = array();

             $sql = 'select idPays, libPays from pays';

             $requete = $this->pdo->prepare($sql);
             $requete->execute();

             while ($pays = $requete->fetch(PDO::FETCH_OBJ))
                 $listePays[] = new Pays($pays);

             $requete->closeCursor();
             return $listePays;
         }
    }
?>