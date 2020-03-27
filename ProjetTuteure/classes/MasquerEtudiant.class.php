<?php
class MasquerEtudiant{
	private $idEtudiant;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idEtudiant': $this->setId_etudiant($valeur); break;
            }
        }
    }


    public function getId_etudiant(){
		return $this->idEtudiant;
	}
	public function setId_etudiant($valeur){
		$this->idEtudiant=$valeur;
	}

}