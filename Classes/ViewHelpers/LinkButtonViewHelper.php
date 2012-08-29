<?php
class Tx_PbToto_ViewHelpers_LinkButtonViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @param string $link 
	 * @param string $class
	 */
	public function render($link,$class) {
		
		return 
		'<div class="'.$class.'">'
		.$link.'
		</div>';
	}
}

?>


