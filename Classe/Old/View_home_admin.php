<?php
namespace classe;

class View_home_admin {
	private $dossier;
	private $fichier;
	private $titre;

	
	
	public function __construct($dossier, $fichier, $titre) {
		
		$this->fichier     = $fichier;
		$this->titre       = $titre;
		$this->dossier     = $dossier;

	}
	
	// public function AfficherVue($tableau = array()) {
	public function AfficherVue($recipes, $cooks) {
		
		// extract($tableau);
		
		$dossier     = $this->dossier;
		$fichier     = $this->fichier;
		$titre       = $this->titre;

		
		ob_start();
		include(ROOT.'/'.$dossier.'/'.$fichier.'.php');
		$content = ob_get_clean();
		include(VIEW_ADMIN.'/_Default_admin.php');
	}
}