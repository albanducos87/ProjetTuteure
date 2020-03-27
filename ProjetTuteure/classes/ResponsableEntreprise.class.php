<?php
class ResponsableEntreprise{
	private $idResponsableEnt;
	private $idEntreprise;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idResponsableEnt': $this->setId_responsable_entreprise($valeur); break;
                case 'idEntreprise': $this->setId_entreprise($valeur);break;
            }
        }
    }


    public function getId_responsable_entreprise(){
		return $this->idResponsableEnt;
	}
	public function setId_responsable_entreprise($valeur){
		$this->idResponsableEnt=$valeur;
	}

	public function getId_entreprise(){
		return $this->idEntreprise;
	}
	public function setId_entreprise($valeur){
		$this->idEntreprise=$valeur;
	}
}