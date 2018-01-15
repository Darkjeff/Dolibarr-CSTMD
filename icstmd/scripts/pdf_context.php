<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) <2017> SaaSprov.ma <saasprov@gmail.com>
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

if (!class_exists('pdf_context', false)) {
    
    class pdf_context {
    
        /**
         * Modi
         *
         * @var integer 0 = file | 1 = string
         */
        var $_mode = 0;
        
    	var $file;
    	var $buffer;
    	var $offset;
    	var $length;
    
    	var $stack;
    
    	// Constructor
    
    	function pdf_context(&$f) {
    		$this->file =& $f;
    		if (is_string($this->file))
    		    $this->_mode = 1;
    		$this->reset();
    	}
    
    	// Optionally move the file
    	// pointer to a new location
    	// and reset the buffered data
    
    	function reset($pos = null, $l = 100) {
    	    if ($this->_mode == 0) {
            	if (!is_null ($pos)) {
        			fseek ($this->file, $pos);
        		}
        
        		$this->buffer = $l > 0 ? fread($this->file, $l) : '';
        		$this->length = strlen($this->buffer);
        		if ($this->length < $l)
                    $this->increase_length($l - $this->length);
    	    } else {
    	        $this->buffer = $this->file;
    	        $this->length = strlen($this->buffer);
    	    }
    		$this->offset = 0;
    		$this->stack = array();
    	}
    
    	// Make sure that there is at least one
    	// character beyond the current offset in
    	// the buffer to prevent the tokenizer
    	// from attempting to access data that does
    	// not exist
    
    	function ensure_content() {
    		if ($this->offset >= $this->length - 1) {
    			return $this->increase_length();
    		} else {
    			return true;
    		}
    	}
    
    	// Forcefully read more data into the buffer
    
    	function increase_length($l = 100) {
			if ($this->_mode == 0 && feof($this->file)) {
				return false;
			} elseif ($this->_mode == 0) {
			    $totalLength = $this->length + $l;
			    do {
			    	$toRead = $totalLength - $this->length;
			    	if ($toRead < 1)
			    		break;
			    
			    	$this->buffer .= fread($this->file, $toRead);
	            } while ((($this->length = strlen($this->buffer)) != $totalLength) && !feof($this->file));
				
				return true;
			} else {
		        return false;
			}
		}
    }
}