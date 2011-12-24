<?php
/**
 * @author Theodoor van Donge
 * @package Utils
 */


namespace Utils;


use ArrayObject;


/**
 * This class tries to fill the gap between Java ArrayList and php arrays and the array object
 */
class ArrayList extends ArrayObject {
	
	
	/**
	 * @var string The type identifier for the ArrayList
	 */
	protected $type;
	
	
	/**
	 * Constructor for ArrayList class, and it is possible to set a type for the ArrayList
	 * 
	 * @param string $type
	 * @param array $array Initial array insert
	 */
	public function __construct($type = null, array $array = array()) {
		if (null == $this->type) {
			parent::__construct($array);
		} else {
			parent::__construct(array());
			
			$this->setType($type);
			
			foreach ($array as $object) {
				$this->add($object);
			}
		}
	}
	
	
	/**
	 * This method set the type used in the ArrayList
	 * 
	 * @param string $type
	 * @throws InvalidArgumentException If the type identifier is not a string
	 */
	public function setType($type) {
		if (!is_string($type)) {
			throw new InvalidArgumentException('Type identifier must be a string');
		}
		if (null != $this->type) {
			$this->forceChangeType($type);
		}
	}
	
	
	/**
	 * This method fetch the type used in the ArrayList
	 * 
	 * @return string $type
	 */
	public function getType() {
		return $this->type;
	}
	
	
	/**
	 * With this method you can change the type for the 
	 * ArrayList after instanciate
	 * 
	 * @param string $type
	 * @throws InvalidArgumentException
	 */
	public function forceChangeType($type) {
		if (!is_string($type)) {
			throw new InvalidArgumentException('Type identifier must be a string');
		}
		$this->type = $type;
	}
	
	
	/**
	 * This method add a object to the ArrayObject
	 * 
	 * @param stdClass $object
	 */
	public function add($object) {
		if ($this->isTypeOf($object)) {
			return parent::append($object);
		}
		throw new InvalidArgumentException('Object must be of the type: ' . $this->type);
	}
	
	
	/**
	 * Returns true if $this->type is yet not set, 
	 * or if $object is a type of the setted type, 
	 * else throws an InvalidArgumentException 
	 * 
	 * @param stdClass $object
	 * @throws InvalidArgumentException If type is set, or if the type isn't equals the setted type 
	 */
	public function isTypeOf($object) {
		if (null == $this->type) {
			return true;
		} else if ($object instanceof $this->type) {
			return true;
		} else {
			return false;
		}
	}
	
	
	/**
	 * This method push all values of the ArrayObject one position higher, 
	 * and prepends a given object to the beginning of the ArrayObject.
	 * See also this page: http://php.net/manual/en/function.array-unshift.php
	 * 
	 * @see http://php.net/manual/en/function.array-unshift.php
	 * @uses array_unshift
	 * @param stdClass $object
	 */
	public function unshift($object) {
		$tempArray = parent::getArrayCopy();
		array_unshift($tempArray, $object);
		parent::exchangeArray($tempArray);
	}
	
	
	/**
	 * This method can merge different lists, or array types 
	 * 
	 * @param AbstractMergeArrayStrategy $mergeStrategy
	 * @param any type of array supported by the merge strategy
	 * @return 
	 * @see http://php.net/manual/en/function.array-merge.php
	 * @uses array_merge 
	 * @throws InvalidArgumentException
	 */
	public function merge(AbstractMergeArrayStrategy $mergeStrategy, $otherArray) {
		return $mergeStrategy->merge($this, $otherArray);
	}
}
