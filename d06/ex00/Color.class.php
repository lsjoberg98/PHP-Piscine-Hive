<?php
class Color
{
    public static $verbose = false;
    public $red = 0;
    public $green = 0;
    public $blue = 0;

    public static function doc()
    {
        echo file_get_contents("Color.doc.txt");
    }

    public function __construct(array $rgb_arr)
    {
        if (isset($rgb_arr['rgb'])) {
            $this->red = (int)$rgb_arr['rgb'] >> 16 & 0xFF;
            $this->green = (int)$rgb_arr['rgb'] >> 8 & 0xFF;
            $this->blue = (int)$rgb_arr['rgb'] & 255;
        } else {
            $this->red = (int)$rgb_arr['red'];
            $this->green = (int)$rgb_arr['green'];
            $this->blue = (int)$rgb_arr['blue'];
        }
        if (self::$verbose)
            print ($this . " constructed.\n");
        return;
    }

    function __destruct() {
        if (self::$verbose)
            print ($this." destructed.\n");
    }

    public function __toString()
    {
        return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue));
    }

    public function mult($f)
    {
        return (new Color(array('red' => $this->red * $f, 'green' => $this->green * $f, 'blue' => $this->blue * $f)));
    }


    public function add(Color $rhs)
    {
        return (new Color(array('red' => $this->red + $rhs->red, 'green' => $this->green + $rhs->green, 'blue' => $this->blue + $rhs->blue)));
    }

    public function sub(Color $rhs)
    {
        return (new Color(array('red' => $this->red - $rhs->red, 'green' => $this->green - $rhs->green, 'blue' => $this->blue - $rhs->blue)));
    }

}
?>