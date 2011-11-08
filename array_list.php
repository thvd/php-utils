<?php


namespace Utils;


use ArrayObject;


/**
 * This class is a (not a complete) equivalent to the Java ArrayList class
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
	 */
	public function __construct($type = null) {
		parent::__construct(array());
		
		if (null != $type) {
			$this->setType($type);
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
	 * With this method you can change the type for the ArrayList 'on the fly'
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
	 * @param Object $object
	 */
	public function add($object) {
		if ($this->isTypeOf($object)) {
			parent::append($object);
		}
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
			throw new InvalidArgumentException('Object must be of the type: ' . $this->type);
		}
	}
	
	
	/**
	 * This method push all values of the ArrayObject one position higher, 
	 * and prepends a given object to the beginning of the ArrayObject.
	 * See also this page: http://php.net/manual/en/function.array-unshift.php
	 * 
	 * @see http://php.net/manual/en/function.array-unshift.php
	 * @param stdClass $object
	 */
	public function unshift($object) {
		$tempArray = parent::getArrayCopy();
		array_unshift($tempArray, $object);
		parent::exchangeArray($tempArray);
	}
}
