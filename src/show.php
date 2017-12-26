<?php 

function LoadShows()
{
	$shows = array();
	foreach (glob("shows/*", GLOB_ONLYDIR) as $dir)
	{
		$dir = substr($dir, 6);
		$newShow = new Show();
		
		if($newShow->LoadShow($dir) != false);
			$shows[] = $newShow;
	}
	return $shows;
}
function LoadShow($slug)
{
	$show = new Show();
	$show->LoadShow($slug);
	return $show;
}

class Show
{
	public $title;
	public $slug;
	public $seasons;
	public $coverImg;
	public $heroImg;

	public function LoadShow($showName)
	{
		$this->slug = $showName;

		$directory = SYS_ROOT . "\shows\\$showName";

		if(!is_dir($directory))
			return false;

		$jsonFile = "$directory\\$showName.json";

		if(!is_file($jsonFile))
			return false;

		$json = json_decode(file_get_contents($jsonFile));

		$this->title = $json->title;

		$seasons = array();
		foreach ($json->seasons as $index => $jSeason)
		{
			$season = new Season();
			$season->title = $jSeason->title;
			$season->directory = $jSeason->path;
			$season->regex = $jSeason->regex;
			$season->quality = $jSeason->quality;
			$season->format = $jSeason->format;
			$season->show = $this;
			$season->index = $index + 1;
			$seasons[] = $season;
		}
		$this->seasons = $seasons;

		if(is_file("$directory/cover.jpg"))
			$this->coverImg = WebPath("/shows/$showName/cover.jpg");

		if(is_file("$directory/hero.jpg"))
			$this->heroImg = WebPath("/shows/$showName/hero.jpg");
	}
	public function GetEpisode($season, $episode)
	{
		return $this->seasons[$season]->GetEpisode($episode);
	}
}

?>