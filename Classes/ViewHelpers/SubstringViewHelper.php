<?php
class Tx_PbToto_ViewHelpers_SubstringViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 *
	 * @param int $maxCharacters
	 * @param string $text 
	 * @param string $behind
	 */
	public function render($maxCharacters,$text,$behind) {
		return substr($text, 0, $maxCharacters).$behind;

	}
}

?>


