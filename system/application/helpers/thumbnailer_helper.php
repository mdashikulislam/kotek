<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');
/*****
  * Thumbnailer is a very flexible helper that generates thumbnails easily but only when
  * a thumnail with the same dimensions don't yet exist, making it light on server load.
  * @author     Stephen Belanger
  * @email      admin@withstyledesign.com
  * @filename   thumbnailer_healper.php
  * @title      Thumbnailer
  * @url        http://www.withstyledesign.com/
  * @version    1.0
  *****/

    function thumbnailer($filename, $path, $scalevalue="100", $scalemode = 'auto') {
        // Get current diimensions
        list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT'].$path.$filename);

        // Set scaled dimensions
        switch ($scalemode) {
            case 'auto':
                if ($width > $height) {
                    $newwidth = $scalevalue;
                    $newheight = ($scalevalue / $width) * $height;
                } else {
                    $newwidth = ($scalevalue / $height) * $width;
                    $newheight = $scalevalue;
                } 
                break;
            case 'x':
                $newwidth = $scalevalue;
                $newheight = ($scalevalue / $width) * $height;
                break;
            case 'y':
                $newwidth = ($scalevalue / $height) * $width;
                $newheight = $scalevalue;
                break;
        }

        // Load
		
        $source = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].$path.$filename);
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        
        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        
        // Output Handling
        $thumbpath = $_SERVER['DOCUMENT_ROOT'].$path."thumbs/".$scalemode."_".$scalevalue."_".$filename;
        if(!file_exists($thumbpath))
            imagejpeg($thumb, $thumbpath);

        return base_url()."images/product/"."thumbs/".$scalemode."_".$scalevalue."_".$filename;
    }?>