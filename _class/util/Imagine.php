<?php

# Imagine Class Beta ############################################
#                                                               #
#   Classe PHP para tratamento de Imagens                       #
#   Criada por Leonardo Giori (leonardo@giori.com.br)           #
#   gambiarra.com.br/imagine                                    #
#                                                               #
#   A classe pode ser usada para qualquer fim não comercial.   #
#   Para fins comerciais entre em contato com o autor.          #
#   Deve-se dar os créditos ao autor original.                 #
#   http://creativecommons.org/licenses/by-sa/2.5/br/           #
#                                                               #
#################################################################


if(!function_exists("imagefilter"))
{
	die("Error");
}

class Imagine{
	
	public $version = "0.0.3 201107091945"; //19 July 2011 19:45 
	
	private $source;	
	private $width;
	private $height;
	private $type;
	private $ext;	
	private $path;
	private $propertys;	
	private $mimes;
	
	public function __construct()
	{
		$this->path = trim(dirname(__FILE__), "/") . "/";
		$this->propertys = array("MASK", "BORDER", "ROTATE", "RESIZE", "FLIP", "CUT", "FILTER", "MERGE", "ROUND", "TEXT", "FONT");
		$this->mimes = array("GIF", "JPEG", "PNG");
	}
	
	public function image($path, $effect, $output="", $quality=75)
	{ 
		$effect = explode(";", $effect);		
		$this->input($path);				
		foreach($effect as $fx)
		{		
			$attr = $this->getAttr($fx, true);
			$attrs = "";
			foreach($attr as $k=>$v)
				$attrs.= ($k>0) ? " " . trim($v): "";
			$this->setProperty($attr[0], trim($attrs));	
		}
		$this->output($output, $quality);
	}
	
	public function getFonts()
	{
		 $fonts = scandir($this->path . "fonts/");
		 foreach($fonts as $font)
		 	if(strtolower(substr($font, -4))==".ttf")
				$r[] = ucfirst(substr($font, 0, -4));
		 return $r;		 
	}


	private function input($path)
	{		
		$type = $this->getType($path);				
		$this->source = $this->imageCreateFrom($type[0], $path);
		$this->width 	= imagesx($this->source);
		$this->height = imagesy($this->source);
		$this->type = $type[0];
		$this->ext = $type[1];
		imagesavealpha($this->source, true);
    }
	
	private function output($img, $quality)
	{	
		if($img=="")
		{
			header("Content-disposition: filename=image"); 
			header("Content-Type: image/" . strtolower($this->type));				
		}				
		$image = create_function('$attr1, $attr2, $attr3','image' . $this->type . '($attr1, $attr2 ,$attr3);');
		$quality = $this->getSizePixel($quality, 100);
		if($this->type=="PNG" and $quality>=100) $quality = 99;

		switch($this->type)
		{
			case "PNG": 	$image($this->source, $img, ($quality/10));     break;
			case "JPEG":	$image($this->source, $img, $quality);          break;
			case "GIF": 	$image($this->source, $img);                    break;
		}		
	}
	
	private function setProperty($case, $attr)
	{
		$case = explode("-", $case);
		switch(strtoupper($case[0]))
		{	
			case "BORDER":   $this->border($attr);        break;
			case "BOX":      $this->box($attr);           break;
			case "CUT":      $this->cut($attr);           break;
			case "FILTER":   $this->filter($attr);        break;
			case "FLIP":     $this->flip($attr);          break;
			case "FONT":     $this->font($attr);          break;
			case "MASK":     $this->mask($attr);          break;
			case "MERGE":    $this->merge($attr);         break;
			case "RESIZE":   $this->resize($attr);        break;
			case "ROTATE":   $this->rotate($attr);        break;
			case "ROUND":    $this->round($attr, $case);  break;
			case "TEXT":     $this->text($attr);          break;
			case "TRIM":     $this->trim($attr);          break;
		}		
	}


		private function border($attr)
		{
			$attr = $this->getAttr($attr);
			$rgb = $this->getRGB($attr[1]);			
			$size = $this->getSizePixel($attr[0], $this->width);			 
			$x2 = imagesx($this->source) - 1;
			$y2 = imagesy($this->source) - 1;			
			$this->imageBox(0, 0, $x2, $y2, $size, $rgb[0]);
		}
		
		private function box($attr)
		{
			$attr = $this->getAttr($attr);
			$rgb = $this->getRGB($attr[4]);
			$w = $this->getSizePixel($attr[2]);
			$h = $this->getSizePixel($attr[3]);	
			$xy = $this->getPosition($attr[0], $attr[1], $this->width, $this->height, $w, $h);			
			$size = $this->getSizePixel($attr[5]);
			if($rgb) imagefilledrectangle($this->source, $xy[0], $xy[1], $w+$xy[0], $h+$xy[1], $rgb[0]);
			$rgbo = $this->getRGB($attr[6]);
			$this->imageBox($xy[0], $xy[1], $w, $h, $size, $rgbo[0]);
		}
		
		private function cut($attr)
		{	
			$attrs = $this->getAttr($attr);
			$this->source = $this->imageCut($this->source, $attr);
			$this->width = $this->getSizePixel($attrs[2], $this->width);
			$this->height = $this->getSizePixel($attrs[3], $this->height);
		}
		
		private function filter($filter=NULL)
		{			
			$fxs = explode(",", $filter);						
			foreach($fxs as $fx)
			{
				$fx = explode(" ", $this->trimAll(strtoupper($fx)));					
				switch($fx[0])
				{
					case "GRAYSCALE":
						imagefilter($this->source, IMG_FILTER_GRAYSCALE);
						break;					
					case "EMBOSS":
						imagefilter($this->source, IMG_FILTER_EMBOSS);
						break;					
					case "NEGATIVE":
						imagefilter($this->source, IMG_FILTER_NEGATE);
						break;					
					case "EDGEDETECT":
						imagefilter($this->source, IMG_FILTER_EDGEDETECT);
						break;					
					case "SMOOTH":
						imagefilter($this->source, IMG_FILTER_GAUSSIAN_BLUR);
						break;					
					case "MEAN_REMOVAL":
						imagefilter($this->source, IMG_FILTER_MEAN_REMOVAL);
						break;
					case "BLUR":
						$n = 27 - $this->getSizePixel($fx[1], 30);
						if($n>-4 and $n<27) imagefilter($this->source, IMG_FILTER_SMOOTH, $n);
						break;
					case "ARTISTIC":
						imagefilter($this->source, IMG_FILTER_CONTRAST, -175);
						imagefilter($this->source, IMG_FILTER_SMOOTH, -7);
						break;
					case "SNAKE":
						imagefilter($this->source, IMG_FILTER_CONTRAST, -175);
						imagefilter($this->source, IMG_FILTER_PIXELATE, 4);
						imagefilter($this->source, IMG_FILTER_SMOOTH, -7);
						break;
					case "CARTOON":
						imagefilter($this->source, IMG_FILTER_CONTRAST, -75);
						imagefilter($this->source, IMG_FILTER_SMOOTH, -8);
						break;
					case "RUSTIC":
						imagefilter($this->source, IMG_FILTER_SMOOTH, -9);
						imagefilter($this->source, IMG_FILTER_CONTRAST, -75);
						break;
					case "DOS":
						imagefilter($this->source, IMG_FILTER_SMOOTH, -8);
						break;
					case "SHARP":
						imagefilter($this->source, IMG_FILTER_SMOOTH, -9);
						break;
					case "PIXELATE":
						$t = (strtoupper($fx[2])=="TRUE") ? true: false;
						imagefilter($this->source, IMG_FILTER_PIXELATE, $this->getSizePixel($fx[1], $this->width), $t);
						break;					
					case "SEPIA":
						imagefilter($this->source, IMG_FILTER_GRAYSCALE);
						imagefilter($this->source, IMG_FILTER_COLORIZE, 85, 55, 35);
						break;					
					case "BRIGHTNESS":
						imagefilter($this->source, IMG_FILTER_BRIGHTNESS, $this->getSizePixel($fx[1], 510, 255));
						break;						
					case "CONTRAST":
						imagefilter($this->source, IMG_FILTER_CONTRAST, $this->getSizePixel($fx[1], 200, 100));
						break;									
					case "COLOR":
						$hex = $this->isHexColor($fx[1]);
						if($hex)
						{ 
							$fx = $this->getRGB($hex);
							imagefilter($this->source, IMG_FILTER_COLORIZE, $fx[1]-127, $fx[2]-127, $fx[3]-127);
						}
						else
						{
							imagefilter($this->source, IMG_FILTER_COLORIZE, $this->getSizePixel($fx[1],255), $this->getSizePixel($fx[2],255), $this->getSizePixel($fx[3],255));
						}
						break;						
				}
			}			
		}
			
		private function flip($case)
		{
			$tmp = imagecreatetruecolor($this->width, $this->height);			
			$x = $this->width;
			$y = $this->height;			
			switch($this->trimAll(strtoupper($case)))
			{
				case "HORIZONTAL":
				case "X":
				case "H":
					imagecopyresampled($tmp, $this->source, 0, 0, ($x-1), 0, $x, $y, 0-$x, $y);
					$this->source = $tmp;
					break;				
				case "VERTICAL":
				case "Y":
				case "V":
					imagecopyresampled($tmp, $this->source, 0, 0, 0, ($y-1), $x, $y, $x, 0-$y);
					$this->source = $tmp;
					break;				
				case "BOTH":
					$this->rotate(180, "#FFF");			
					break;				
				default:
					break;
			}		
		}
		
		private function font($attr)
		{
			$attr = $this->getAttr($attr);			
			$text = (substr($attr[0], 0, 1)=="(" and substr($attr[0], -1)==")") ? $arr = substr($attr[0], 1, -1) : $attr[0];
			$rep = array("/\\\NEWLINE/is"=>chr(1), "/\n/is"=>chr(1), "/\<br\>/is"=>chr(1), "/\<br \/\>/is"=>chr(1), "/\\\nl/is"=>chr(1));
			$text = preg_replace(array_keys($rep), array_values($rep), $text);
			$alpha = $this->getSizePixel(intval($attr[6])."%", 100);
			$size = $attr[3];
			$rgb = $this->getRGB($attr[5]);		
			$color = imagecolorallocate($this->source, $rgb[1], $rgb[2], $rgb[3]);
			$font = (substr($attr[4], -4)==".ttf") ? $attr[4] : "$attr[4].ttf";
			$font = (file_exists($this->path . "fonts/$font")) ? $this->path . "fonts/$font" : $this->path . "fonts/times.ttf";
			$texts = explode(chr(1), $text);						
			$w = $size * strlen($attr[0]); 
			$h = $size + intval($size/2);
			$water = $this->imageCreateTrueColorAlpha($w, $h);			
			$trans_colour = imagecolorallocatealpha($water, 0, 0, 0, 127);
			imagefill($water, 0, 0, $trans_colour);			

			foreach($texts as $k=>$v)
			{	
				$down = ($size*$k)+($k*10);				
				$wh = imagettfbbox($size , $degree , $font , trim($v));				
				$xy = $this->getPosition($attr[1], $attr[2], $this->width, $this->height, $wh[2], ($wh[5]*-1));
				imagettftext($water, $size, 0, 5, $size+5, $color, $font, trim($v));
			}

			$water = $this->imageTrim($water, NULL);
			$rotate = $this->getSizePixel($attr[7], 360);
			$alpha2 = imagecolorallocatealpha($water, 0, 0, 0, 127);
			$water = imagerotate($water, $rotate, $alpha2);			
			$w = imagesx($water);
			$h = imagesy($water);			
			$xy = $this->getPosition($attr[1], $attr[2], $this->width, $this->height, $w, $h);
			$this->imageCopyMergeAlpha($this->source, $water, $xy[0], $xy[1], 0, 0, $w, $h, $alpha);
		}
		
		private function mask($attr)
		{		
			$attr = $this->getAttr($attr);
			if($this->ext=="png")
			{			
				$temp = $this->imageCreateTrueColorAlpha($this->width, $this->height);				
			}
			else
			{
				$temp = imagecreatetruecolor($this->width, $this->height);
				$rgb = $this->getRGB($attr[2]);
				$background = imagecolorallocate($temp, $rgb["red"], $rgb["green"], $rgb["blue"]);
				imagefilledrectangle($temp, 0, 0, $this->width, $this->height, $background);
			}	
			$maskType = $this->getType($attr[0]);		
			$mask = $this->imageCreateFrom($maskType[0], $attr[0]);
			$maskW = imagesx($mask);
			$maskH = imagesy($mask);			
			if($maskW!=$this->width or $maskH!=$this->height)
			{
				$resize = imagecreatetruecolor($this->width, $this->height);		
				imagesavealpha($resize, true);
				imagealphablending($resize, false);					
				imagecopyresampled($resize, $mask, 0, 0, 0, 0, $this->width, $this->height, $maskW, $maskH);			
				$mask = $resize;
			}
			for($n=0;$n<=$this->width;$n++)
				for($i=0;$i<=$this->height;$i++)
				{
					$rgb = imagecolorsforindex($mask, imagecolorat($mask, $n, $i));				
					$rgb2 = imagecolorsforindex($this->source, imagecolorat($this->source, $n, $i));				
					$alpha = round(((127/255) * (($rgb["red"] + $rgb["green"] + $rgb["blue"]) / 3)));
					if($attr[1]=="false") $alpha = 127 - $alpha;
					$color = imagecolorallocatealpha($temp, $rgb2["red"], $rgb2["green"], $rgb2["blue"], $alpha);
					imagesetpixel($temp, $n, $i, $color);
				}
			$this->source = $temp;
		}
		
		private function merge($attr)
		{	
			$attr = $this->getAttr($attr);
			$type = $this->getType($attr[0]);
			$water = $this->imageCreateFrom($type[0], $attr[0]);
			$rotate = $this->intBetween($this->getSizePixel($attr[4], 0), 0, 360);
			$alpha = imagecolorallocatealpha($water, 0, 0, 0, 127);
			$water = imagerotate($water, $rotate, $alpha);
			$water = $this->imageTrim($water, NULL);
			$w = imagesx($water);
			$h = imagesy($water);								
			$xy = $this->getPosition($attr[1], $attr[2], $this->width, $this->height, $w, $h);
			$alpha = $this->intBetween($this->getSizePixel($attr[3], 100), 0, 100);
			$this->imageCopyMergeAlpha($this->source, $water, $xy[0], $xy[1], 0, 0, $w, $h, $alpha);				
		}
			
		private function resize($attr)
		{		
			$attr = $this->getAttr($attr);			
			$w = $this->getSizePixel($attr[0], $this->width);
			$h = $this->getSizePixel($attr[1], $this->height);
			$wh = $this->getProportion($w, $h, $this->width, $this->height);					
			$tmp = imagecreatetruecolor($wh[0], $wh[1]);
			imagesavealpha($tmp, true);
			imagealphablending($tmp, false);			
			$sizer = $this->getResize($this->width, $this->height, $wh[0], $wh[1], $attr[2]);								
			imagecopyresampled($tmp, $this->source, $sizer[2], $sizer[3], 0, 0, $sizer[0], $sizer[1], $this->width, $this->height);
			$this->width = $wh[0];
			$this->height = $wh[1];			
			$this->source = $tmp;			
		}
			
		private function rotate($attr)
		{	
			$attr = $this->getAttr($attr);
			$rgb = $this->getRGB($attr[1]);			
			$oldsize = array($this->width, $this->height);
			$this->source = imagerotate($this->source, $this->getSizePixel($attr[0], 360), $rgb[0]);
			$this->width = imagesx($this->source);
			$this->height = imagesy($this->source);
			if(strtolower($attr[2])!="false")  $this->resize("$oldsize[0] $oldsize[1] false");			
		}

		private function round($attr, $case) 
		{
			$attr = $this->getAttr($attr);			
			$border = $this->getSizePixel($attr[0], 0);
			if($border==0) return false;			
			switch(strtoupper(trim($case[1] . "-" . $case[2], "-")))
			{			
				case "TOP":             $b = array(1,0,0,1);	break;			
				case "BOTTOM":          $b = array(0,1,1,0);	break;			
				case "LEFT":            $b = array(1,1,0,0);	break;			
				case "RIGHT":           $b = array(0,0,1,1);	break;			
				case "TOP-LEFT":
				case "LEFT-TOP":        $b = array(1,0,0,0);	break;			
				case "TOP-RIGHT":
				case "RIGHT-TOP":       $b = array(0,0,0,1);	break;			
				case "BOTTOM-RIGHT":
				case "RIGHT-BOTTOM":    $b = array(0,0,1,0);	break;			
				case "BOTTOM-LEFT":
				case "LEFT-BOTTOM":     $b = array(0,1,0,0);	break;
				default:                $b = array(1,1,1,1);	break;
			}			
			$ini = $border * 3 - 1;		
			$arc = $ini * 2 + 1;			
			$size[0] = $this->width;
			$size[1] = $this->height;		
			$background = imagecreatetruecolor($size[0], $size[1]);
			imagecopymerge($background, $this->source, 0, 0, 0, 0, $size[0], $size[1], 100);			
			$x1 = $size[0] * 2-1;
			$y1 = $size[1] * 2-1;			
			$tmp = imagecreatetruecolor($x1, $y1);		
			imagecopyresampled($tmp, $background, 0, 0, 0, 0, $x1, $y1, $size[0], $size[1]);					
			$rgb = $this->getRGB($attr[1]);		
			$color = imagecolorallocate($tmp, $rgb[1], $rgb[2], $rgb[3]);			
			$XX[0] = array($ini,       $ini,        180,   270,    0,     0);
			$XX[1] = array($ini,       $y1-$ini,    90,    180,    0,     $y1);
			$XX[2] = array($x1-$ini,   $y1-$ini,    0,     90,     $x1,   $y1);
			$XX[3] = array($x1-$ini,   $ini,        270,   360,    $x1,   0);
			$n = 0;			
			for($n==0; $n<=3; $n++)
			{		
				if($b[$n])
				{
					imagearc($tmp, $XX[$n][0], $XX[$n][1], $arc, $arc, $XX[$n][2], $XX[$n][3], $color);
					imagefilltoborder($tmp, $XX[$n][4], $XX[$n][5], $color, $color);
				}
			}
			imagecopyresampled($this->source, $tmp, 0, 0, 0, 0, $size[0], $size[1], $x1, $y1);
		}
		
		private function text($attr)
		{	
			$attr = $this->getAttr($attr);
			$text = (substr($attr[0], 0, 1)=="(" and substr($attr[0], -1)==")") ? $arr = substr($attr[0], 1, -1) : $attr[0];
			$size = $this->getSizePixel($attr[3], 5);
			$alpha = $this->getSizePixel(intval($attr[6])."%", 100);			
			$bErr = ($this->isHexColor($attr[5])) ? 1 : 0;			
			$w = imagefontwidth($size) * strlen($text); 
			$h = imagefontheight($size);
			$rep = array("/\\\NEWLINE/is"=>chr(1), "/\n/is"=>chr(1), "/\<br\>/is"=>chr(1), "/\<br \/\>/is"=>chr(1), "/\\\nl/is"=>chr(1));
			$text = preg_replace(array_keys($rep), array_values($rep), $text);
			$texts = explode(chr(1), $text);		
			$water = $this->imageCreateTrueColorAlpha($w + $bErr, $bErr + ($h*(count($texts))));			
			$trans_colour = imagecolorallocatealpha($water, 0, 0, 0, 127);
			imagefill($water, 0, 0, $trans_colour);
			foreach($texts as $k=>$text)
			{
				if($this->isHexColor($attr[5]))
				{
					$loc[0] = array(-1,  1, -1, 1, 0,  0, 1, -1);
					$loc[1] = array(-1, -1,  1, 1, 1, -1, 0,  0);					
					$rgb2 = $this->getRGB($attr[5]);				
					for($n=0;$n<8;$n++)
					{		
						$alpha2 = ($n>4)? 1: 75;
						$color2 = imagecolorallocatealpha($this->source, $rgb2[1], $rgb2[2], $rgb2[3], $alpha2);
						imagestring($water, $size, $loc[0][$n]+1, $loc[1][$n]+($h*$k), $text, $color2);
					}			
				}
				$rgb = $this->getRGB($attr[4]);		
				$color = imagecolorallocate($water, $rgb[1], $rgb[2], $rgb[3]);
				imagestring($water, $size, intval($bErr), ($h*$k), $text, $color);
			}
			$rotate = $this->getSizePixel($attr[7], 360);
			$alpha3 = imagecolorallocatealpha($water, 0, 0, 0, 127);
			$water = imagerotate($water, $rotate, $alpha3);
			$water = $this->imageTrim($water, NULL);
			$w = imagesx($water);
			$h = imagesy($water);
			$xy = $this->getPosition($attr[1], $attr[2], $this->width, $this->height, $w, $h);
			$this->imageCopyMergeAlpha($this->source, $water, $xy[0], $xy[1], 0, 0, $w, $h, $alpha);
		}
		
		private function trim($attr=NULL)
		{
			$attr = $this->getAttr($attr);
			$color = $this->isHexColor($attr[0]);
			$this->source = $this->imageTrim($this->source, $color);			
		}
		
		
	private function getAttr($attr, $double=false)
	{
		$sep = chr(1);		
		$r = array("/\s/is" => $sep);		
		$attr = preg_replace(array_keys($r), array_values($r), $attr);				
		$drop = array($sep);		
		if(preg_match_all('#(\(.*?\))#', $attr, $matches))
			foreach($matches[1] as $match)
				$attr = str_replace($match, preg_replace('#('. implode('|', $drop) .')#', ' ', $match), $attr);
		if($double)
		{
			$attr = explode(":", $attr);
			$output = explode($sep, $this->trimAll($attr[1], $sep));			
			array_unshift($output, trim($attr[0], $sep));
			return $output;
		}
		else
		{		
			$attr = explode($sep, $this->trimAll($attr, $sep));
			return $attr;
		}
	}
	
	private function getPosition($x, $y, $imageWidth, $imageHeight, $waterWidth, $waterHeight)
	{
		switch(strtolower($x))
		{		
			case "center":    $x = ($imageWidth / 2 ) - ($waterWidth / 2);    break;			
			case "left":      $x = 0;                                         break;
			case "right":     $x = $imageWidth - $waterWidth;                 break;			
			default:          $x = $this->getSizePixel($x, $imageWidth);      break;		
		}		
		switch(strtolower($y))
		{		
			case "middle":    $y = ($imageHeight / 2) - ($waterHeight / 2);   break;
			case "top":       $y = 0;                                         break;
			case "bottom":    $y = $imageHeight - $waterHeight;               break;
			default:          $y = $this->getSizePixel($y, $imageHeight);     break;
		}
		$x = ($x<0) ? (($imageWidth - $waterWidth) + $x) : $x;
		$y = ($y<0) ? (($imageHeight - $waterHeight) + $y) : $y;			
		return array($x, $y);	
	}	
	
	private function getProportion($w, $h, $w2, $h2)
	{	
		$w = intval($w);
		$h = intval($h);
		$w2 = intval($w2);
		$h2 = intval($h2);		
		if($w<=0)
			return  array((($h * $w2) / $h2), $h);
		else if($h<=0)
			return  array($w, (($w * $h2) / $w2));			
		else if($h<=0 AND $w<=0)
			return  array($w2, $h2);
		else
			return  array($w, $h);
	}
		
	private function getResize($w, $h, $w2=0, $h2=0, $cut=false)
	{
		if(strtolower($cut)=="true")
		{		
			$pw = (100 / $w) * $w2;	$ph = (100 / $h) * $h2;	
			if($pw < $ph)
			{
				$h3 = $h2; $w3 = $w * $h2 / $h;	$sizer_w = ($w3 - $w2) / 2;	
			}
			elseif($ph<$pw)
			{
				$w3 = $w2; $h3 = $h * $w2/ $w;	$sizer_h = ($h3 - $h2) / 2;
			}
			else
			{
				$h3 = $h2; $w3 = $w2;
			}
			return array(intval($w3),intval($h3),-intval($sizer_w),-intval($sizer_h));			
		}
		else
		{
			return array(intval($w2),intval($h2),0,0);			
		}		
	}
	
	private function getRGB($hex)
	{		
		$hex = trim($this->isHexColor($hex), "#");
		if($hex)
			$c = array(hexdec($hex), hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));			
		else
			$c = array(0, 0, 0, 0);
		return array(0=>$c[0], 1=>$c[1], 2=>$c[2], 3=>$c[3], "integer"=>$c[0], "red"=>$c[1], "green"=>$c[2], "blue"=>$c[3]);
	}
	
	private function getSizePixel($size, $real=0, $ifPercentRemove=0)
	{		
		if(is_numeric($size))
			return $size;
		else if((strpos(strtolower($size),"px")!=0) and (intval($size)!=0))
			return intval(ereg_replace("px","",$size));
		else if((strpos($size,"%")!=0))
			return round((intval(ereg_replace("px","",$real)) / 100) * intval(ereg_replace("%","",$size))) - $ifPercentRemove;
		else
			return 0;
	}
		
	private function getType($path)
	{		
		$type = getimagesize($path);		
		$mime = strtoupper(end(explode("/", $type["mime"])));
		if(!in_array($mime, $this->mimes)){ echo "Err: Format file (<b>$mime</b>) is not valid"; exit; }				
		return array($mime, substr($path, strrpos($path,".")+1));			
	}	
	
	private function imageBox($x, $y, $w, $h, $size, $color)
	{
		$w = $w + $x;
		$h = $h + $y;
		for($i=0;$i<$size;$i++)
			imageline($this->source, $x, $y+$i, $w, $y+$i, $color);
		for($i=0;$i<$size;$i++)
			imageline($this->source, $w-$i, $y, $w-$i, $h, $color);
		for($i=0;$i<$size;$i++)
			imageline($this->source, $x, $h-$i, $w, $h-$i, $color);
		for($i=0;$i<$size;$i++)
			imageline($this->source, $x+$i, $y, $x+$i, $h, $color);
	}
	
	private function imageCopyMergeAlpha($image, $water, $waterX, $waterY, $imageX, $imageY, $waterWidth, $waterHeight, $opacity=0)
	{        
		$w = imagesx($water);
		$h = imagesy($water);		
		$cut = imagecreatetruecolor($waterWidth, $waterHeight);
		imagecopy($cut, $image, 0, 0, $waterX, $waterY, $waterWidth, $waterHeight);
		$opacity = 100 - $opacity;		
		imagecopy($cut, $water, 0, 0, $imageX, $imageY, $waterWidth, $waterHeight);
		imagecopymerge($image, $cut, $waterX, $waterY, $imageX, $imageY, $waterWidth, $waterHeight, $opacity);		
		return $image;		
	}
	
	private function imageCreateFrom($type, $image)
	{
		$imagecreatefrom = "imagecreatefrom" . strtolower($type);
		return $imagecreatefrom($image);
	}
	
	private function imageCreateTrueColorAlpha($w, $h)
	{	
		$tmp = imagecreatetruecolor($w, $h);
		imagesavealpha($tmp, true);
		imagealphablending($tmp, false);
		return $tmp;
	}
	
	private function imageCut($source, $attr)
	{		
		$attr = $this->getAttr($attr);		
		$w = imagesx($source);
		$h = imagesy($source);
		$attr[2] = ($attr[2]==0) ? $w : $attr[2] ;
		$attr[3] = ($attr[3]==0) ? $h : $attr[3] ;		
		$w = $this->getSizePixel($attr[2], $w);
		$h = $this->getSizePixel($attr[3], $h);			
		$x = $this->getSizePixel($attr[0], $w);
		$y = $this->getSizePixel($attr[1], $h);
		$tmp = $this->imageCreateTrueColorAlpha($w, $h);		
		imagecopy($tmp, $source, 0, 0, $x, $y, $w, $h);		
		return $tmp;
	}
	
	private function imageTrim($source, $color=NULL)
	{	
		if(strtoupper($color)=="TRANSPARENT")
			$trim = NULL;
		else if($this->isHexColor($color))
			$trim = hexdec($this->isHexColor($color));	
		else
			$trim = imagecolorat($source, 0, 0);
		$w = imagesx($source);
		$h = imagesy($source);		
		for($x=0;$x<=$w-1;$x++)
			for($y=0;$y<=$h-1;$y++)
			{
				$rgb = imagecolorat($source, $x, $y);
				$index = imagecolorsforindex($source, $rgb);
				if(($rgb!=$trim and $trim) or (!$trim and $index["alpha"]!=127)){ $left = $x; break 2; }
			}			
		for($y=0;$y<=$h-1;$y++)
			for($x=0;$x<=$w-1;$x++)
			{
				$rgb = imagecolorat($source, $x, $y);
				$index = imagecolorsforindex($source, $rgb);
				if(($rgb!=$trim and $trim) or (!$trim and $index["alpha"]!=127)){ $top = $y; break 2; }
			}		
		for($x=$w-1;$x>=0;$x--)
			for($y=$h-1;$y>=0;$y--)
			{
				$rgb = imagecolorat($source, $x, $y);
				$index = imagecolorsforindex($source, $rgb);
				if(($rgb!=$trim and $trim) or (!$trim and $index["alpha"]!=127)){ $width = ($x - $left) + 1; break 2; }
			}			
		for($y=$h-1;$y>=0;$y--)
			for($x=$w-1;$x>=0;$x--)
			{
				$rgb = imagecolorat($source, $x, $y);
				$index = imagecolorsforindex($source, $rgb);
				if(($rgb!=$trim and $trim) or (!$trim and $index["alpha"]!=127)){ $height = ($y - $top) + 1; break 2; }
			}
		return $this->imageCut($source, $left . "px " . $top . "px " . $width . "px " . $height . "px");
	}
	
	private function intBetween($val, $min, $max)
	{
		if(!is_numeric($val)) return $max - $min;
		else if($val>$max) return $max;
		else if($val<$min) return $min;
		else return $val;
	}
	
	private function isHexColor($hex)
	{		
		$hex = eregi_replace("([^0-9,A-F])", "", trim(strtoupper($hex)));
		$len = strlen($hex);
		if($len==6)
		{
			return "#" . $hex;
		}
		else if($len==3)
		{
			$f = array(substr($hex,0,1), substr($hex,1,1), substr($hex,2,1));
			return "#" . $f[0] .  $f[0] .  $f[1] .  $f[1] .  $f[2] .  $f[2]; 
		}
		else
		{
			return false;
		}		
	}
	
	private function trimAll($str, $sep=" ")
	{		
		$s = explode($sep ,$str);
		foreach($s as $s1)
			$str2.= ($s1!="") ? $s1.$sep : "";
		return trim($str2, $sep);	
	}	

}