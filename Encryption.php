<?php

namespace Encryption;

class Encryption{
	
    private $translation = [
        '0' => null,
        '1' => null,
        '2' => null,
        '3' => null,
        '4' => null,
        '5' => null,
        '6' => null,
        '7' => null,
        '8' => null,
        '9' => null,
        'A' => null,
        'B' => null,
        'C' => null,
        'D' => null,
        'E' => null,
        'F' => null,
        'G' => null,
        'H' => null,
        'I' => null,
        'J' => null,
        'K' => null,
        'L' => null,
        'M' => null,
        'N' => null,
        'O' => null,
        'P' => null,
        'Q' => null,
        'R' => null,
        'S' => null,
        'T' => null,
        'U' => null,
        'V' => null,
        'W' => null,
        'X' => null,
        'Y' => null,
        'Z' => null,
        'a' => null,
        'b' => null,
        'c' => null,
        'd' => null,
        'e' => null,
        'f' => null,
        'g' => null,
        'h' => null,
        'i' => null,
        'j' => null,
        'k' => null,
        'l' => null,
        'm' => null,
        'n' => null,
        'o' => null,
        'p' => null,
        'q' => null,
        'r' => null,
        's' => null,
        't' => null,
        'u' => null,
        'v' => null,
        'w' => null,
        'x' => null,
        'y' => null,
        'z' => null,
        '.' => null,
        ' ' => null,
        '!' => null,
        '@' => null,
        '#' => null,
        '$' => null,
        '%' => null,
        '^' => null,
        '&' => null,
        '*' => null,
        '(' => null,
        ')' => null,
        '-' => null,
        '_' => null,
        '+' => null,
        '=' => null,
        '\\' => null,
        '{' => null,
        '}' => null,
        '"' => null,
        "'" => null,
        '/' => null
    ];
    
	private $separator = "";
	
	private $separatorKey = '$k@41$';
	
	private $implodeKey = 'R256!i';

    public function __construct(){
        foreach ($this->translation as $key => $value) {
            $this->translation[$key] = $this->rand();
        }
        $this->separator = $this->rand();
    }

    private function rand($length = 6){
    	$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
	    $str = '';
	    $count = strlen($charset);
	    while ($length--) {
	        $str .= $charset[mt_rand(0, $count-1)];
	    }
	    return $str;
    }
    
    public function setToken($token = ''){
    	if($token === ''){
    		return;
    	}
    	$splitToken = explode($this->separatorKey, $token);
    	$this->separator = $splitToken[1];
    	$keys = explode($this->implodeKey, $splitToken[0]);
    	$i = 0;
    	foreach ($this->translation as $key => $value) {
    		$this->translation[$key] = $keys[$i];
    		$i++;
    	}
    }

	public function getToken(){
		return implode($this->implodeKey, $this->translation) . $this->separatorKey . $this->separator;
	}
	
    public function encode(string $str = '', string $result = ''){
        if($str === ''){
    		return;
    	}
        foreach (str_split($str) as $char) {
            if (isset($this->translation[$char])) {
                $result .= $this->separator . $this->translation[$char];
            }
        }

        return trim($result);
    }

    public function decode(string $str = '', string $result = '') {
        if($str === ''){
    		return;
    	}
        $characters = array_flip($this->translation);
        foreach (explode($this->separator, $str) as $character) {
            if (isset($characters[$character])) {
                $result .= $characters[$character];
            }
        }
        return $result;
    }
}
