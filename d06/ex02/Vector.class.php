<?php
	class Vector{
		private $_x;
		private $_y;
		private $_z;
		private $_w = 0.0;
		public static $verbose = false;
		public static function doc()
		{
			echo file_get_contents("./Vector.doc.txt").PHP_EOL;
		}

		public function magnitude(){
			return ((float)sqrt(pow($this->_x, 2)
				+ pow($this->_y, 2)
				+ pow($this->_z, 2)));
		}

		public function normalize(){
			$length = $this->magnitude();
			if ($length != 1)
				return (new Vector(array ('dest' => new Vertex
				(array('x' => $this->_x / $length,
					'y' => $this->_y / $length,
					'z' => $this->_z / $length)))));
			else
				return (clone($this));
		}
		public function add($rhs){
			return (new Vector(array('dest' => new Vertex
			(array('x' => $this->_x + $rhs->_x,
				'y' => $this->_y + $rhs->_y,
				'z' => $this->_z + $rhs->_z)))));
		}

		public function sub($rhs){
			return (new Vector(array('dest' => new Vertex
			(array('x' => $this->_x - $rhs->_x,
				'y' => $this->_y - $rhs->_y,
				'z' => $this->_z - $rhs->_z)))));
		}

		public function opposite(){
			return (new Vector(array('dest' => new Vertex
			(array('x' => $this->_x * -1,
				'y' => $this->_y  * -1,
				'z' => $this->_z * -1)))));
		}
		public function scalarProduct($k)
		{
			return (new Vector(array('dest' => new Vertex
			(array('x' => $this->_x * $k,
				'y' => $this->_y  * $k,
				'z' => $this->_z * $k)))));
		}

		public function dotProduct($rhs)
		{
			return((float)($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z));
		}

		public function cos($rhs)
		{
			$prod = $this->dotProduct($rhs);
			$magn = $this->magnitude() * $rhs->magnitude();
			return ((float) $prod / $magn);
		}

		public function crossProduct($rhs){
			return new Vector(array('dest' => new Vertex
				(array('x' => $this->_y * $rhs->getZ() - $this->_z * $rhs->getY(),
				'y' => $this->_z * $rhs->getX() - $this->_x * $rhs->getZ(),
				'z' => $this->_x * $rhs->getY() - $this->_y * $rhs->getX()))));
		}

		public function __construct($arr){
			if (isset($arr['dest']) && $arr['dest'] instanceof  Vertex)
			{
				if (isset($arr['orig']) && $arr['orig'] instanceof  Vertex)
					$orig = new Vertex(array('x' => $arr['orig']->getX(),
				'y' => $arr['orig']->getY(),
				'z' => $arr['orig']->getZ()));
			else
				$orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
				$this->_x = $arr['dest']->getX() - $orig->getX();
				$this->_y = $arr['dest']->getY() - $orig->getY();
				$this->_z = $arr['dest']->getZ() - $orig->getZ();
				$this->_w = 0.0;
			}
			if (self::$verbose)
				print $this->__toString(). " constructed".PHP_EOL;
		}

		public function __toString()
		{
			return sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->_x, $this->_y, $this->_z, $this->_w);
		}

		public function __destruct()
		{
			if (self::$verbose)
				print $this . " destructed" .PHP_EOL;
		}

		public function getX(){
			return $this->_x;
		}
		public function getY(){
			return $this->_y;
		}
		public function getZ(){
			return $this->_z;
		}
		public function getW(){
			return $this->_w;
		}
	}

?>