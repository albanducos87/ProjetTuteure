<?php
class Diplome{
	private $idDiplome;
	private $niveauDiplome;
	private $libDiplome;

	public function __construct($valeurs = array()) {
    	if (!empty($valeurs))
           $this->affecte($valeurs);
    }

	 public function affecte($donnees){
        foreach ($donnees as $attribut => $valeur){
            switch ($attribut){
                case 'idDiplome': $this->setId_diplome($valeur); break;
                case 'niveauDiplome': $this->setNiveau_diplome($valeur); break;
                case 'libDiplome': $this->setLib_diplome($valeur);break;
            }
        }
    }


    public function getId_diplome(){
		return $this->idDiplome;
	}
	public function setId_diplome($valeur){
		$this->idDiplome=$valeur;
	}


	public function getNiveau_diplome(){
		return $this->niveauDiplome;
	}
	public function setNiveau_diplome($valeur){
		$this->niveauDiplome=$valeur;
	}


	public function getLib_diplome(){
		return $this->libDiplome;
	}
	public function setLib_diplome($valeur){
		$this->libDiplome=$valeur;
	}
}
