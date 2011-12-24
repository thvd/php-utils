<?php
/**
 * @author Theodoor van Donge
 * @package Utils\ArrayList
 */


namespace Utils\ArrayList;


require_once 'utils/array_list/merge_array_strategy.php';
require_once 'utils/array_list.php';


use Utils\ArrayList;


class ArrayList_ArrayObject_Merge2_ArrayList_Strategy extends AbstractMergeArrayStrategy {
	
	
	/**
	 * Can merge an ArrayList and an ArrayObject 
	 * from the php spl, to one ArrayList
	 * 
	 * @see Utils\ArrayList.MergeArrayStrategy::merge()
	 * @return ArrayList
	 */
	function merge($array, $otherArray) {
		if (!($array instanceof ArrayList) || !($otherArray instanceof ArrayObject)) {
			throw new InvalidArgumentException('first parameter must be an ArrayList, second an Spl.ArrayObject');
		}
		
		$array->exchangeArray(array_merge($this->getArrayCopy(), $otherArrayList->getArrayCopy()));
		
	}
	
	
}