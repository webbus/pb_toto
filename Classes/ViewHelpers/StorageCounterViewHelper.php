<?php
class Tx_PbToto_ViewHelpers_StorageCounterViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
	 * @param Tx_Extbase_Persistence_QueryResult $storage
	 */
	public function render($storage) {
		$counter = 0;
		foreach($storage as $single) $counter++;
		
		return ''.$counter;
	}
}

?>


