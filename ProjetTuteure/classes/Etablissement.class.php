<?php
class Etablissement{
	private $idEtablissement;
	private $nomEta;
	private $adresseEta;
	private $cdp;
	private $idVille;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idEtablissement': $this->setId_etablissement($valeur); break;
                case 'nomEta': $this->setNom_etablissement($valeur); break;
                case 'adresseEta': $this->setAdr_etablissmement($valeur);break;
                case 'cdp': $this->setCp_etablissement($valeur);break;
                case 'idVille': $this->setId_ville($valeur);break;
            }
        }
    }


    public function getId_etablissement(){
		return $this->idEtablissement;
	}
	public function setId_etablissement($valeur){
		$this->idEtablissement=$valeur;
	}


	public function getNom_etablissement(){
		return $this->nomEta;
	}
	public function setNom_etablissement($valeur){
		$this->nomEta=$valeur;
	}


	public function getAdr_etablissmement(){
		return $this->adresseEta;
	}
	public function setAdr_etablissmement($valeur){
		$this->adresseEta=$valeur;
	}


	public function getCp_etablissement(){
		return $this->cdp;
	}
	public function setCp_etablissement($valeur){
		$this->cdp=$valeur;
	}

	public function getId_ville(){
		return $this->idVille;
	}
	public function setId_ville($valeur){
		$this->idVille=$valeur;
	}
}
