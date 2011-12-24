<?php
/**
 * @author Theodoor van Donge
 * @package Utils\ArrayList
 *
 */

namespace Utils\ArrayList;


require_once 'utils/array_list/merge_array_strategy.php';
require_once 'utils/array_list.php';


use Utils\ArrayList;


class Array_Array_Merge2_ArrayList_Strategy extends AbstractMergeArrayStrategy {
	
	
	/**
	 * Can merge 2 normal php array's
	 * to one ArrayList 
	 * 
	 * @see Utils\ArrayList.MergeArrayStrategy::merge()
	 * @return array $array
	 */
	function merge($array, $otherArray) {
		if (!is_array($array) || !is_array($otherArray)) {
			throw new InvalidArgumentException('both parameters must be an array');
		}
		
		return new ArrayList(null, array_merge($array, $otherArray));
	}
	
	
}