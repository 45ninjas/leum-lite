<?php
define("SYS_ROOT", __DIR__);
require_once "settings.php";

require_once "src/show.php";
require_once "src/season.php";

$leum = new LeumLite;
class LeumLite
{
	public $title;
	public $page;

	function __construct()
	{
		$args = array();
		if(isset($_GET['arg']))
		{
			// Get the arguments provided.
			$args = explode('/', $_GET['arg']);

			// Get the first argument and use it as the page name.
			$page = array_shift($args);
			$path = SYS_ROOT . "/pages/$page.php";

			// If the page exists, use it.
			if(is_file($path))
			{
				// Include the page file, then set to the page variable.
				include_once $path;
				$this->page = new $page($this, $args);
			}
		}
		// Looks like it's the home page, get that.
		else
		{
			// Include it and set it to the page variable.
			include_once SYS_ROOT . "/pages/browse.php";
			$this->page = new Browse($this, null);
		}
	}

	public function Render()
	{
		$this->page->Render();
	}
}

function WebPath($resourcePath)
{
	return WEB_ROOT . $resourcePath;
}

?>