<?php
/**
 *  
 *  Copyright (C) 2012 paj@gaiterjones.com
 *
 *	This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  @category   PAJ
 *  @package    
 *  @license    http://www.gnu.org/licenses/ GNU General Public License
 * 	
 *
 */

 
class Error
{
    // CATCHABLE ERRORS
    public static function captureNormal( $number, $message, $file, $line )
    {
		// Insert all in one table
        $error = array( 'type' => $number, 'message' => $message, 'file' => $file, 'line' => $line );
        // Display content $error variable
		echo '<div style="background-color: #ffebe8; border: 1px solid #dd3c10; color: #333333;	padding: 10px; font-size: 13px;	font-weight: bold;">';
		echo '<pre>An error was detected:';
        print_r( $error );
        echo '</pre>';
		echo '</div><br/>';
    }
    
    // EXCEPTIONS
    public static function captureException( $exception )
    {
        // Display content $exception variable
        echo '<div style="background-color: #ffebe8; border: 1px solid #dd3c10; color: #333333;	padding: 10px; font-size: 13px;	font-weight: bold;">';
		echo '<pre>An uncaught exception error was detected:';
        print_r( $exception );
        echo '</pre>';
		echo '</div><br/>';
    }
    
    // UNCATCHABLE ERRORS
    public static function captureShutdown( )
    {
        $error = error_get_last( );
        if( $error ) {
            
            // Display content $error variable
            echo '<div style="background-color: #ffebe8; border: 1px solid #dd3c10; color: #333333;	padding: 10px; font-size: 13px;	font-weight: bold;">';
			echo '<pre>A fatal error was detected:';
            print_r( $error );
            echo '</pre>';
			echo '</div><br/>';
        } else { return true; }
    }
	
}

?>
	

