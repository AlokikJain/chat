<?php session_start(); ?>
<?php

/**
renders template
*/

	function render($template, $data = [])
	{
		$path = $template . ".php";
		if(file_exists($path))
		{
			extract($data);
			require($path);
		}
	}

	/**
	 * display message in the pages
	 */
	function flash_message($type, $message)
	{
    	$_SESSION['message'] = array('type' => $type, 'message' => $message);
	}

?>