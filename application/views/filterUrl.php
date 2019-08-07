<?php

class filterScholar{
	
	var $arrayGaruda;

	public function cariGaruda(){
		foreach($html->find("h3[class=gs_rt]") as $ambilLink){
			$links = $ambilLink->find('a');
			foreach ($links as $link){
			$garuda = '<a href='.$link->href.'></a>'.$link.'<br>';		
			}
			$search = 'garuda.ristekdikti';
			if(preg_match("/{$search}/i", $garuda)) {
    		echo $garuda;
			}else{
			echo 'Not Found';
			}
		}
}
	
	public function cariISJD(){
		foreach($html->find("h3[class=gs_rt]") as $ambilLink){
			$links = $ambilLink->find('a');
			foreach ($links as $link){
			$isjd = '<a href='.$link->href.'></a>'.$link.'<br>';		
			}
			$search = 'isjd.pdii.lipi';
			if(preg_match("/{$search}/i", $isjd)) {
    		echo $isjd;
			}else{
			echo 'Not Found';
			}
		}
	}
	
	public function cariTekno(){
		foreach($html->find("h3[class=gs_rt]") as $ambilLink){
			$links = $ambilLink->find('a');
			foreach ($links as $link){
			$tekno = '<a href='.$link->href.'></a>'.$link.'<br>';		
			}
			$search = 'h';
			if(preg_match("/{$search}/i", $tekno)) {
    		echo $tekno;
			}else{
			echo 'Not Found';
			}
		}
	}

}

?>

?>