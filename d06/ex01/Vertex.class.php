<?php
require_once "Color.class.php";
class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_color;
	private $_w = 1.0;
	public static $verbose = false;
	public static function doc()
	{
		echo file_get_contents("./Vertex.doc.txt").PHP_EOL;
	}

	public function __construct(array $arr)
	{
		$this->_x = $arr['x'];
		$this->_y = $arr['y'];
		$this->_z = $arr['z'];
		if (isset($arr['color']) && !empty($arr['color']))
			$this->_color = $arr['color'];
		else
			$this->_color = new Color( array('red' => 0xFF, 'green' => 0xFF, 'blue' => 0xFF));
		if (isset($arr['w']) )
			$this->_w =	$arr['w'];
		else
			$this->_w = 1.0;
		if (self::$verbose)
			print ($this . " constructed" . PHP_EOL);
	}

	public function __toString()
	{
		$str = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f", 
			$this->_x, $this->_y, $this->_z, $this->_w);
		if (self::$verbose) {
			$str = $str . ", " . $this->_color->__toString();
		}
		$str = $str. " )";
		return $str;
	}
	
	public function __destruct() {
		if (self::$verbose)
		print $this . " destructed" . PHP_EOL;
	}

	public function setX($x)
	{
		$this->_x = $x;
	}

	public function setY($y)
	{
		$this->_y = $y;
	}

	public function setZ($z)
	{
		$this->_z = $z;
	}

	public function setColor($color)
	{
		$this->_color = $color;
	}

	public function getX()
	{
		return ($this->_x);
	}

	public function getY()
	{
		return ($this->_y);
	}

	public function getZ()
	{
		return ($this->_z);
	}

	public function getW()
	{
		return ($this->_w);
	}

	public function getColor()
	{
		return ($this->_color);
	}
}

?>