<?php
class CVde{
	private $idCV;
	private $idEtudiant;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idCV': $this->setId_cv($valeur); break;
                case 'idEtudiant': $this->setId_etudiant($valeur);break;
            }
        }
    }

    public function getId_cv(){
		return $this->idCV;
	}
	public function setId_cv($valeur){
		$this->idCV=$valeur;
	}

	public function getId_etudiant(){
		return $this->idEtudiant;
	}
	public function setId_etudiant($valeur){
		$this->idEtudiant=$valeur;
	}
}