<?php
class Security {

    private static $seed = 'MaCrGjKs9J';
	public static function chiffrer($texte_en_clair) {
		$texte_chiffre = hash('sha256', $texte_en_clair . Security::$seed);
		return $texte_chiffre;
	}
}
?>