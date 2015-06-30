<?php

namespace RDConverter;

class RDConverter{
	
	// Amersfoort params
	private static $X0 = 155E3;
	private static $Y0 = 463E3;
	private static $lat0 = 52.1551744;
	private static $lng0 = 5.38720621;

	public function gps2X($lat, $lon) {
		$XpqR = array(1 => array('p' => 0,'q' => 1,'R' => 190094.945),2 => array('p' => 1,'q' => 1,'R' => -11832.228),3 => array('p' => 2,'q' => 1,'R' => -114.221),4 => array('p' => 0,'q' => 3,'R' => -32.391),5 => array('p' => 1,'q' => 0,'R' => -0.705),6 => array('p' => 3,'q' => 1,'R' => -2.34),7 => array('p' => 1,'q' => 3,'R' => -0.608),8 => array('p' => 0,'q' => 2,'R' => -0.008),9 => array('p' => 2,'q' => 3,'R' => 0.148));

	    $a = 0;
	    $dlat = 0.36 * ($lat - self::$lat0);
	    $dlng = 0.36 * ($lon - self::$lng0);
	    for ($i = 1; 10 > $i; $i++) {
	    	$a += $XpqR[$i]['R'] * pow($dlat, $XpqR[$i]['p']) * pow($dlng, $XpqR[$i]['q']);
	    }
	    return self::$X0 + $a;
	}

	public function gps2Y($lat, $lon) {
		$YpqS = array(1 => array('p' => 1,'q' => 0,'S' => 309056.544),2 => array('p' => 0,'q' => 2,'S' => 3638.893),3 => array('p' => 2,'q' => 0,'S' =>73.077 ),4 => array('p' => 1,'q' => 2,'S' => -157,984),5 => array('p' => 3,'q' => 0,'S' => 59.788),6 => array('p' => 0,'q' => 1,'S' => 0.433),7 => array('p' => 2,'q' => 2,'S' => -6.439),8 => array('p' => 1,'q' => 1,'S' => -0.032),9 => array('p' => 0,'q' => 4,'S' => 0.092),10 => array('p' => 1,'q' => 4,'S' => -0.054));

	    $a = 0;
	    $dlat = 0.36 * ($lat - self::$lat0);
	    $dlng = 0.36 * ($lon - self::$lng0);
	    for ($i = 1; 11 > $i; $i++) {
	    	$a += $YpqS[$i]['S'] * pow($dlat, $YpqS[$i]['p']) * pow($dlng, $YpqS[$i]['q']);
	    }
	    return self::$Y0 + $a;
	}

	public function RD2lat($X, $Y) {
		$latpqK = array(1 => array('p' => 0,'q' => 1,'K' => 3235.65389),2 => array('p' => 2,'q' => 0,'K' => -32.58297),3 => array('p' => 0,'q' => 2,'K' => -0.2475),4 => array('p' => 2,'q' => 1,'K' => -0.84978),5 => array('p' => 0,'q' => 3,'K' => -0.0665),6 => array('p' => 2,'q' => 2,'K' => -0.01709),7 => array('p' => 1,'q' => 0,'K' => -0.00738),8 => array('p' => 4,'q' => 0,'K' => 0.0053),9 => array('p' => 2,'q' => 3,'K' => -3.9E-4),10 => array('p' => 4,'q' => 1,'K' => 3.3E-4),11 => array('p' => 1,'q' => 1,'K' => -1.2E-4));

	    $a = 0;
	    $dX = 1E-5 * ($X - self::$X0);
	    $dY = 1E-5 * ($Y - self::$Y0);
	    for ($i = 1; 12 > $i; $i++) {
	    	$a += $latpqK[$i]['K'] * pow($dX, $latpqK[$i]['p']) * pow($dY, $latpqK[$i]['q']);
	    }
	    return self::$lat0 + $a / 3600;
	}

	public function RD2lng($X, $Y) {
		$lngpqL = array(1 => array('p' => 1,'q' => 0,'K' => 5260.52916),2 => array('p' => 1,'q' => 1,'K' => 105.94684),3 => array('p' => 1,'q' => 2,'K' => 2.45656),4 => array('p' => 3,'q' => 0,'K' => -0.81885),5 => array('p' => 1,'q' => 3,'K' => 0.05594),6 => array('p' => 3,'q' => 1,'K' => -0.05607),7 => array('p' => 0,'q' => 1,'K' => 0.01199),8 => array('p' => 3,'q' => 2,'K' => -0.00256),9 => array('p' => 1,'q' => 4,'K' => 0.00128),10 => array('p' => 0,'q' => 2,'K' => 2.2E-4),11 => array('p' => 2,'q' => 0,'K' => -2.2E-4),12 => array('p' => 5,'q' => 0,'K' => 2.6E-4));

	    $a = 0;
	    $dX = 1E-5 * ($X - self::$X0);
	    $dY = 1E-5 * ($Y - self::$Y0);
	    for ($i = 1; 13 > $i; $i++) {
	    	$a += $lngpqL[$i]['K'] * pow($dX, $lngpqL[$i]['p']) * pow($dY, $lngpqL[$i]['q']);
	    }
	    return self::$lng0 + $a / 3600;
	}
}
