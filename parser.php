<?php


	/*
	 * CSSPARSER
	 * Copyright (C) 2009 Peter Kröner
	 * 
	 * This program is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 * 
	 * You should have received a copy of the GNU General Public License
	 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 */


	/*
	 * PARSE
	 * General purpose CSS parser. Parses some CSS into an array
	 */

	function parse($css){
		// Remove Comments
		$css = preg_replace('/\/\*(.*)?\*\//Usi', '', $css);
		// Extract @media-blocks into $blocks
		preg_match_all('/@.+?\}[^\}]*?\}/ms',$css,$blocks);
		// Append the rest to $blocks
		array_push($blocks[0],preg_replace('/@.+?\}[^\}]*?\}/ms','',$css));
		$ordered = array();
		for($i=0;$i<count($blocks[0]);$i++){
			// If @media-block, strip declaration and parenthesis
			if(substr($blocks[0][$i],0,6) === '@media') 
			{
				$ordered_key = preg_replace('/^(@media[^\{]+)\{.*\}$/ms','$1',$blocks[0][$i]);
				$ordered_value = preg_replace('/^@media[^\{]+\{(.*)\}$/ms','$1',$blocks[0][$i]);
			}
			// Rule-blocks of the sort @import or @font-face
			elseif(substr($blocks[0][$i],0,1) === '@')
			{
				$ordered_key = $blocks[0][$i];
				$ordered_value = $blocks[0][$i];
			}
			else 
			{
				$ordered_key = 'main';
				$ordered_value = $blocks[0][$i];
			}
			// Find any unlogical parenthesis and replace then with something that makes no trouble
			$ordered_value = preg_replace('/(\'[^\']*)\{([^\']*\')/sm','$1####o####$2',$ordered_value);
			$ordered_value = preg_replace('/(\'[^\']*)\}([^\']*\')/sm','$1####c####$2',$ordered_value);
			$ordered_value = preg_replace('/("[^"]*)\{([^"]*")/sm','$1####o####$2',$ordered_value);
			$ordered_value = preg_replace('/("[^"]*)\}([^"]*")/sm','$1####c####$2',$ordered_value);
			$ordered_value = preg_replace('/(\{[^\}]*)\{/sm','$1####o####',$ordered_value);
			$ordered_value = preg_replace('/\}([^\{]*\})/sm','####c####$1',$ordered_value);
			
			$ordered[$ordered_key] = preg_split('/[\{\}]/',trim($ordered_value," \r\n\t"),-1,PREG_SPLIT_NO_EMPTY);
		}
		
		// Beginning to rebuild new slim CSS-Array
		foreach($ordered as $key => $val){
			$new = array();
			for($i = 0; $i<count($val); $i++){
				// Split selectors and rules and split properties and values
				$selector = str_replace(array('####o####','####c####'),array('{','}'),trim($val[$i]," \r\n\t"));
				
				if(!empty($selector)){
					if(!isset($new[$selector])) $new[$selector] = array();

					$rules = explode(';', str_replace(array('####o####','####c####'),array('{','}'),$val[++$i]));
					foreach($rules as $rule){
						$rule = trim($rule," \r\n\t");
						if(!empty($rule)){
							$rule = array_reverse(explode(':', $rule));
							$property = trim(array_pop($rule)," \r\n\t");
							$value = implode(':', array_reverse($rule));
							
							if(!isset($new[$selector][$property]) || !preg_match('/!important/',$new[$selector][$property])) $new[$selector][$property] = $value;
							elseif(preg_match('/!important/',$new[$selector][$property]) && preg_match('/!important/',$value)) $new[$selector][$property] = $value;
						}
					}
				}
			}
			$ordered[$key] = $new;
		}
		return $ordered;
	}

	/*
	 * GLUE
	 * Turn an array back into CSS
	 */
	function glue($array){
		$css = '';
		foreach($array as $media => $content){
			if(substr($media,0,6) === '@media'){
				$css .= $media . " {\n";
				$prefix = "\t";
			}
			else $prefix = "";
			
			foreach($content as $selector => $rules){
				$css .= $prefix.$selector . " {\n";
				foreach($rules as $property => $value){
					$css .= $prefix."\t".$property.': '.$value;
					$css .= ";\n";
				}
				$css .= $prefix."}\n\n";
			}
			if(substr($media,0,6) === '@media'){
				$css .= "}\n\n";
			}
		}
		// Back-insert all unlogical parenthesis
		$css = str_replace(array('####o####','####c####'),array('{','}'),$css);
		return $css;
	}


?>