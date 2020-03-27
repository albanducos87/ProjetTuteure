<?php
class Pays{
	private $idPays;
	private $libPays;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

     public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idPays': $this->setId_pays($valeur); break;
                case 'libPays': $this->setNom_pays($valeur); break;
            }
        }
    }


	public function getId_pays(){
		return $this->idPays;
	}
	public function setId_pays($valeur){
		$this->idPays=$valeur;
	}

	public function getNom_pays(){
		return $this->libPays;
	}
	public function setNom_pays($valeur){
		$this->libPays=$valeur;
	}
}