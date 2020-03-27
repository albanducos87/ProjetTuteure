<?php
class MasquerResponsableEntreprise{
	private $idResponsableEnt;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idResponsableEnt': $this->setId_Responsable_Ent($valeur); break;
            }
        }
    }


    public function getId_Responsable_Ent(){
		return $this->idResponsableEnt;
	}
	public function setId_Responsable_Ent($valeur){
		$this->idResponsableEnt=$valeur;
	}

}