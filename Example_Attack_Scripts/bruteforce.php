<?php 
$name0 = $_POST['password']; 	/* get the value of a password sent using method="post" from the login      form */
$start_time = microtime(true);               /*microtime() function returns the current timestamp. This function is used to start the timer for calculating	the time required to brute force the password */
set_time_limit(300);  	/*set_time_limit fuction is used to set the number of seconds a script is allowed to run*/
$MD = md5($name0);	/*encryption scheme used to encrypt the password recieved using method="post"*/
define('h_value', $MD);    	/*define() function defines h_value constant with md5 hash of a password*/
$p = strlen($name0);
define('P_MAX_LEN',$p );  	/*define() function defines P_MAX_LEN constant with $p i.e. length of password entered, which is the maximum length of a password to brute force*/
$c_set = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';          /*character set which is used to brute force the password*/
// $c_set = 'etaoinshrdlcumwfgypbvkxjqz';
$c_len = strlen($c_set); 		/*strlen() function is used to find the length of the character set*/
function repeat($width, $position, $character)
{     
	global $c_set, $c_len; 
		
	for ($i = 0; $i < $c_len; $i++) 
	{        
		if ($position  < $width - 1) 
		{    
			repeat($width, $position + 1, $character . $c_set[$i]); 
		}
		     
		test($character . $c_set[$i]);    
	}
} 

// This test function comes from a resource online, we can change it for the CTF based on the nodes on Deter. 
function test($password)	 /*test function is used to check the md5 of password with the md5 of the string generated by repeat*/
{     
	global $start_time;		/*global variable $start_time*/
if (hash('md5', $password) == h_value) 	/*comparing hash of password with the hash of words formed using repeat function*/
	{        
		echo '<br/><br/>'.'FOUND MATCH, password: '.$password."\r\n";  
$end_time = microtime(true);	 /*$end_time variable stores the time when the execution ends*/
$time_taken = $end_time-$start_time; 	/*$time_taken variable stores the time taken for processing*/
		
echo '<br/></br>'.'time taken for processing is '.round($time_taken).' seconds';
		exit;    
	}
}  
echo 'target hash: '.h_value."\r\n";
repeat(P_MAX_LEN, 0, ''); 			/*call to repeat() function*/
echo "NO PASSWORD FOUND";  
?>