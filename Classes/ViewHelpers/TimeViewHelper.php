<?php

class Tx_PbToto_ViewHelpers_TimeViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
	 * @param string $unixtime
	 * @param boolean $long
	 */
	public function render($unixtime,$long=false) {
		if(!$unixtime && $long)  return date("d.m.Y",time());
		else if(!$unixtime && $long)  return date("d.m",time());
		else if($long) return date("d.m.Y",$unixtime);
		else return date("d.m.",$unixtime);
	}
}

?>
