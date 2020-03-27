<?php
class Ville{
	private $idVille;
	private $libVille;
	private $idPays;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

     public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idVille': $this->setId_ville($valeur); break;
                case 'libVille': $this->setNom_ville($valeur); break;
                case 'idPays': $this->setId_pays($valeur); break;
            }
        }
    }


	public function getId_ville(){
		return $this->idVille;
	}
	public function setId_ville($valeur){
		$this->idVille=$valeur;
	}

	public function getNom_ville(){
		return $this->libVille;
	}
	public function setNom_ville($valeur){
		$this->libVille=$valeur;
	}

	public function getId_pays(){
		return $this->idPays;
	}
	public function setId_pays($valeur){
		$this->idPays=$valeur;
	}
}

