<?php
class Demande{
	private $id_etudiant;
	private $id_stage;
	private $accepte;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idEtudiant': $this->setId_etudiant($valeur); break;
                case 'idStage': $this->setId_stage($valeur);break;
                case 'accepte': $this->setAccepte($valeur);break;
            }
        }
    }


    public function getId_etudiant(){
		return $this->id_etudiant;
	}
	public function setId_etudiant($valeur){
		$this->id_etudiant=$valeur;
	}

	public function getId_stage(){
		return $this->id_stage;
	}
	public function setId_stage($valeur){
		$this->id_stage=$valeur;
	}

    public function getAccepte(){
		return $this->accepte;
	}
	public function setAccepte($valeur){
		$this->accepte=$valeur;
	}
}