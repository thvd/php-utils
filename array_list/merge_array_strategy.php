<?php
/**
 * @author theodoor
 * @package Utils\ArrayList
 */


namespace Utils\ArrayList;


abstract class AbstractMergeArrayStrategy {
	
	
	/**
	 * @param $array
	 */
	public abstract function merge($array);
	
}