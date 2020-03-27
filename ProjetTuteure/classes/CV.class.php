<?php
class CV{
	private $idCV;
	private $langue;
	private $idDiplome;
	private $description;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idCV': $this->setId_cv($valeur); break;
                case 'langue': $this->setLangue($valeur);break;
                case 'idDiplome': $this->setId_diplome($valeur); break;
                case 'description': $this->setDescription($valeur); break;
            }
        }
    }

    public function getId_cv(){
		return $this->idCV;
	}
	public function setId_cv($valeur){
		$this->idCV=$valeur;
	}

	public function getLangue(){
		return $this->langue;
	}
	public function setLangue($valeur){
		$this->langue=$valeur;
	}

    public function getId_diplome(){
		return $this->idDiplome;
	}
	public function setId_diplome($valeur){
		$this->idDiplome=$valeur;
	}
	
	public function getDescription(){
	    return $this->description;
	}
	public function setDescription($valeur){
	    $this->description=$valeur;
	}
}
