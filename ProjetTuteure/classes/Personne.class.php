<?php

class Personne {
	private $idPersonne;
	private $nom;
	private $prenom;
	private $telephone;
	private $administrateur;
	private $persMail;
	private $passwd;
	private $naissance;


	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idPersonne': $this->setId_personne($valeur); break;
                case 'nom': $this->setNom_personne($valeur); break;
                case 'prenom': $this->setPrenom_personne($valeur);break;
                case 'telephone': $this->setNum_personne($valeur);break;
                case 'administrateur': $this->setAdmin($valeur);break;
                case 'persMail': $this->setMail_personne($valeur);break;
                case 'passwd': $this->setMdp_personne($valeur);break;
                case 'naissance': $this->setDate_naissance_personne($valeur);break;
            }
        }
    }



    public function getId_personne(){
		return $this->idPersonne;
	}
	public function setId_personne($valeur){
		$this->idPersonne=$valeur;
	}


	public function getNom_personne(){
		return $this->nom;
	}
	public function setNom_personne($valeur){
		$this->nom=$valeur;
	}

	public function getPrenom_personne(){
		return $this->prenom;
	}
	public function setPrenom_personne($valeur){
		$this->prenom=$valeur;
	}

	public function getNum_personne(){
		return $this->telephone;
	}
	public function setNum_personne($valeur){
		$this->telephone=$valeur;
	}

	public function getAdmin(){
		return $this->administrateur;
	}
	public function setAdmin($valeur){
		$this->administrateur=$valeur;
	}

	public function getMail_personne(){
		return $this->persMail;
	}
	public function setMail_personne($valeur){
		$this->persMail=$valeur;
	}

	public function getMdp_personne(){
		return $this->passwd;
	}
	public function setMdp_personne($valeur){
		$this->passwd=$valeur;
	}

	public function getDate_naissance_personne(){
		return $this->naissance;
	}
	public function setDate_naissance_personne($valeur){
		$this->naissance=$valeur;
	}
}
?>