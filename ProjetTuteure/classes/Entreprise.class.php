<?php
class Entreprise{
	private $idEntreprise;
	private $nomEntreprise;
	private $mailEntreprise;
	private $numSiren;
	private $telEntreprise;
	private $adresseEta;
	private $cdp;
	private $idVille;


	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idEntreprise': $this->setId_entreprise($valeur); break;
                case 'nomEntreprise': $this->setNom_entreprise($valeur); break;
                case 'mailEntreprise': $this->setMail_entreprise($valeur);break;
                case 'numSiren': $this->setSiren_entreprise($valeur);break;
                case 'telEntreprise': $this->setNum_entreprise($valeur);break;
                case 'adresseEta': $this->setAdr_entreprise($valeur);break;
                case 'cdp': $this->setCp_entreprise($valeur);break;
                case 'idVille': $this->setId_ville($valeur);break;
            }
        }
    }


    public function getId_entreprise(){
		return $this->idEntreprise;
	}
	public function setId_entreprise($valeur){
		$this->idEntreprise=$valeur;
	}

	public function getNom_entreprise(){
		return $this->nomEntreprise;
	}
	public function setNom_entreprise($valeur){
		$this->nomEntreprise=$valeur;
	}

	public function getMail_entreprise(){
		return $this->mailEntreprise;
	}
	public function setMail_entreprise($valeur){
		$this->mailEntreprise=$valeur;
	}

	public function getSiren_entreprise(){
		return $this->numSiren;
	}
	public function setSiren_entreprise($valeur){
		$this->numSiren=$valeur;
	}

	public function getNum_entreprise(){
		return $this->telEntreprise;
	}
	public function setNum_entreprise($valeur){
		$this->telEntreprise=$valeur;
	}

	public function getAdr_entreprise(){
		return $this->adresseEta;
	}
	public function setAdr_entreprise($valeur){
		$this->adresseEta=$valeur;
	}

	public function getCp_entreprise(){
		return $this->cdp;
	}
	public function setCp_entreprise($valeur){
		$this->cdp=$valeur;
	}

	public function getId_ville(){
		return $this->idVille;
	}
	public function setId_ville($valeur){
		$this->idVille=$valeur;
	}
}
