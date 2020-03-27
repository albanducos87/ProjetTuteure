<?php
class ResponsableEtudiant{
	private $idResponsable;
	private $idEtablissement;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idResponsable': $this->setId_responsable($valeur); break;
                case 'idEtablissement': $this->setId_etablissement($valeur);break;
            }
        }
    }


    public function getId_responsable(){
		return $this->idResponsable;
	}
	public function setId_responsable($valeur){
		$this->idResponsable=$valeur;
	}

	public function getId_etablissement(){
		return $this->idEtablissement;
	}
	public function setId_etablissement($valeur){
		$this->idEtablissement=$valeur;
	}
}