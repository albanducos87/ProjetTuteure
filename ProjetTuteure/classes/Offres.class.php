<?php
class Offres{
	private $idProposition;
	private $idEntreprise;
	private $idStage;
	private $nomEntreprise;
	private $dateDebut;
	private $dateFin;
	private $mission;
	private $langueRequise;


	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idProposition': $this->setIdProposition($valeur); break;
                case 'idEntreprise': $this->setIdEntreprise($valeur);break;
                case 'idStage': $this->setIdStage($valeur); break;
                case 'nomEntreprise' : $this->setNomEntreprise($valeur); break;
                case 'dateDebut' : $this->setDateDebut($valeur); break;
                case 'dateFin' : $this->setDateFin($valeur); break;
                case 'mission' : $this->setMission($valeur); break;
                case 'langueRequise' : $this->setLangueRequise($valeur); break;
            }
        }
    }

    public function getIdProposition(){
		return $this->idProposition;
	}
	public function setIdProposition($valeur){
		$this->idProposition=$valeur;
	}


	public function getIdEntreprise(){
		return $this->idEntreprise;
	}
	public function setIdEntreprise($valeur){
		$this->idEntreprise=$valeur;
	}


    public function getIdStage(){
		return $this->idStage;
	}
	public function setIdStage($valeur){
		$this->idStage=$valeur;
	}


	public function getNomEntreprise(){
		return $this->nomEntreprise;
	}
	public function setNomEntreprise($valeur){
		$this->nomEntreprise = $valeur;
	}


	public function getDateDebut(){
		return $this->dateDebut;
	}
	public function setDateDebut($valeur){
		$this->dateDebut = $valeur;
	}


	public function getDateFin(){
		return $this->dateFin;
	}
	public function setDateFin($valeur){
		$this->dateFin = $valeur;
	}


	public function getMission(){
		return $this->mission;
	}
	public function setMission($valeur){
		$this->mission = $valeur;
	}


	public function getLangueRequise(){
		return $this->langueRequise;
	}
	public function setlangueRequise($valeur){
		$this->langueRequise = $valeur;
	}
}
