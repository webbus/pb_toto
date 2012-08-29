<?php
class Tx_PbToto_ViewHelpers_CounterViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
	 * @param int $name
	 * @param string $modus
	 * @param string $value
	 * @return string
	 */
	public function render($name,$modus="set",$value="0") {
		
		if ($modus == "get") return $GLOBALS[$name];
		else if($modus == "set") $GLOBALS[$name] = $value;
		else if($modus == "increment") $GLOBALS[$name] +=1;
		
		return '';
	}
}

?>


