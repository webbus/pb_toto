<?php
class Tx_PbToto_ViewHelpers_ArrayViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
	 * @param array array
	 * @param string $id id 
	 * @param string $id2 id2
	 */
	public function render($array,$id,$id2=NULL) {
		if($id2)return $array[$id][$id2];
		else return $array[$id];

	}
}

?>


