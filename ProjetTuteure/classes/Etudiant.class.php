<?php
class Etudiant{
	private $idEtudiant;
	private $idEtablissement;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idEtudiant': $this->setId_etudiant($valeur); break;
                case 'idEtablissement': $this->setId_etablissement($valeur); break;
            }
        }
    }


    public function getId_etudiant(){
		return $this->idEtudiant;
	}
	public function setId_etudiant($valeur){
		$this->idEtudiant=$valeur;
	}


	public function getId_etablissement(){
		return $this->idEtablissement;
	}
	public function setId_etablissement($valeur){
		$this->idEtablissement=$valeur;
	}
}