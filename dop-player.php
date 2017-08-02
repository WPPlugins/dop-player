<?php
/*
Plugin Name: DOP Player
Version: 1.0
Plugin URI: http://www.dop-p.com/wordpress/
Description: A plugin to embed the DOP Player to play flv, mov, mp4, m4v, m4a, mp4v, 3gp, 3g2 video files that you add to your post.
Author: Marius-Cristian Donea
Author URI: http://www.mariuscristiandonea.com

Change log:
	
	1.0 (2009-03-24) 
	
		* Initial release.

Installation: Upload the files from the zip file to "wp-content/plugins/"  and activate the plugin in your admin panel. 

Licence:
	
	Copyright 2009 Marius-Cristian Donea  (email : doneamarius@yahoo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

	include "dop-player/dop-player-admin.php";
	
	function replace_video_link($matches)
	{
		$link = preg_split("/[\|]/", $matches[2]);
		$videoURL = $link[0];    
				
		$theClass = new DOPPlayerAdmin();
		$playerURL = get_settings('siteurl').'/wp-content/plugins/dop-player/dop-player.swf';		
		$playerWidth = $theClass->theWidth();   
        $playerHeight = $theClass->theHeight();   
        $playerBgColor = $theClass->theBgColor();
        $playerBgAlpha = $theClass->theBgAlpha();
		$playerCpBgColor = $theClass->theCpBgColor();
        $playerCpBtnBgColor = $theClass->theCpBtnBgColor();                    
        $playerCpBtnOutlineColor =  $theClass->theCpBtnOutlineColor();
		
		$flashVars = "videoURL=".$videoURL."&bgColor=".$playerBgColor."&bgAlpha=".$playerBgAlpha."&cpBgColor=".$playerCpBgColor."&cpBtnBgColor=".$playerCpBtnBgColor."&cpBtnOutlineColor=".$playerCpBtnOutlineColor;
			
		$flashEmbedingCode = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="'.$playerWidth.'" height="'.$playerHeight.'" align="middle">';
		$flashEmbedingCode .= '<param name="movie" value="'.$playerURL.'" />';
		$flashEmbedingCode .= '<param name="allowFullScreen" value="true" />';
		$flashEmbedingCode .= '<param name="allowScriptAccess" value="sameDomain" />';
		$flashEmbedingCode .= '<param name="quality" value="high" />';
		$flashEmbedingCode .= '<param name="wmode" value="transparent" />';
		$flashEmbedingCode .= '<param name="flashvars" value="'.$flashVars.'" />';
		$flashEmbedingCode .= '<embed src="'.$playerURL.'" allowFullScreen="true" allowScriptAccess="sameDomain" quality="high" wmode="transparent" flashvars="'.$flashVars.'" width="'.$playerWidth.'" height="'.$playerHeight.'" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';
		$flashEmbedingCode .= '</object>';
					
		return $flashEmbedingCode;			
	}

	function insert_dop_player($text)
	{								
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\"([^\"]+\.flv)\"( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\"([^\"]+\.mov)\"( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\"([^\"]+\.mp4)\"( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\"([^\"]+\.m4v)\"( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\"([^\"]+\.m4a)\"( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\"([^\"]+\.mp4v)\"( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);			
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\"([^\"]+\.3gp)\"( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\"([^\"]+\.3g2)\"( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\'([^\"]+\.flv)\'( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\'([^\"]+\.mov)\'( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\'([^\"]+\.mp4)\'( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\'([^\"]+\.m4v)\'( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\'([^\"]+\.m4a)\'( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\'([^\"]+\.mp4v)\'( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);			
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\'([^\"]+\.3gp)\'( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);	
		$text = preg_replace_callback( "/<a ([^=]+=\"[^\"]+\" )*href=\'([^\"]+\.3g2)\'( [^=]+=\"[^\"]+\")*>[^<]+<\/a>/i", "replace_video_link", $text);			
		return $text;		
	}
		
	add_filter('the_content', 'insert_dop_player');
	
	
?>