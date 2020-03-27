<?php
class Stage{
	private $idStage;
	private $dateDebut;
	private $nbSemaines;
	private $mission;
	private $langueRequise;
	private $descriptionStage;
	private $titre;
	private $hebergement;
	private $idEntreprise;
	private $idDiplome;
	private $idVille;
	private $etat;
	private $valide;
	private $datePub;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idStage': $this->setId_stage($valeur); break;
                case 'dateDebut': $this->setDateDebut($valeur); break;
                case 'nbSemaines': $this->setNbSemaines($valeur);break;
                case 'mission': $this->setMission($valeur);break;
                case 'langueRequise': $this->setLangueRequise($valeur);break;
                case 'descriptionStage': $this->setDescriptionStage($valeur);break;
                case 'titre': $this->setTitre($valeur);break;
                case 'hebergement': $this->setHebergement($valeur);break;
                case 'idEntreprise': $this->setId_entreprise($valeur);break;
                case 'idDiplome': $this->setId_diplome($valeur);break;
                case 'idVille': $this->setId_ville($valeur);break;
                case 'etat': $this->setEtat($valeur);break;
                case 'valide': $this->setValide($valeur);break;
                case 'datePub': $this->setDatePub($valeur);
            }
        }
    }

    public function getId_stage(){
		return $this->idStage;
	}
	public function setId_stage($valeur){
		$this->idStage=$valeur;
	}

	public function getDateDebut(){
		return $this->dateDebut;
	}
	public function setDateDebut($valeur){
		$this->dateDebut=$valeur;
	}

	public function getNbSemaines(){
		return $this->nbSemaines;
	}
	public function setNbSemaines($valeur){
		$this->nbSemaines=$valeur;
	}

	public function getMission(){
		return $this->mission;
	}
	public function setMission($valeur){
		$this->mission=$valeur;
	}


	public function getLangueRequise(){
		return $this->langueRequise;
	}
	public function setLangueRequise($valeur){
		$this->langueRequise=$valeur;
	}

	public function getDescriptionStage(){
		return $this->descriptionStage;
	}
	public function setDescriptionStage($valeur){
		$this->descriptionStage=$valeur;
	}

	public function getTitre(){
		return $this->titre;
	}
	public function setTitre($valeur){
		$this->titre=$valeur;
	}


	public function getHebergement(){
		return $this->hebergement;
	}
	public function setHebergement($valeur){
		$this->hebergement=$valeur;
	}

	public function getId_entreprise(){
		return $this->idEntreprise;
	}
	public function setId_entreprise($valeur){
		$this->idEntreprise=$valeur;
	}

	public function getId_diplome(){
		return $this->idDiplome;
	}
	public function setId_diplome($valeur){
		$this->idDiplome=$valeur;
	}

	public function getId_ville(){
		return $this->idVille;
	}
	public function setId_ville($valeur){
		$this->idVille=$valeur;
	}
	public function getEtat(){
		return $this->etat;
	}
	public function setEtat($valeur){
		$this->etat = $valeur;
	}


    public function getValide()
    {
        return $this->valide;
    }

    public function setValide($valide)
    {
        $this->valide = $valide;
    }

    public function getDatePub()
    {
        return $this->datePub;
    }

    public function setDatePub($datePub)
    {
        $this->datePub = $datePub;
    }
}