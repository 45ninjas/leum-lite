<?php
class Season
{
	public $index;
	public $title;
	public $directory;
	public $regex;
	public $quality;
	public $format;
	public $show;

	public function GetEpisodes()
	{
		$episodes = array();
		foreach (glob("$this->directory/*.$this->format") as $file)
		{
			$episode["file"] = $file;
			
			preg_match("/(E[0-9])\w+/", $file, $results);
			
			$episode["title"] = $results[0];
			$episode["slug"] = $results[0];

			$episode["link"] = WEB_ROOT . "/watch/".$this->show->slug."/S".$this->index."/".$episode["slug"];

			$episodes[] = $episode;
		}
		return $episodes;
	}

	public function GetEpisode($slug)
	{
		foreach (glob($this->directory . "/*") as $file)
		{		
			preg_match("/(E[0-9])\w+/", $file, $results);

			if($results[0] == $slug)
			{
				$episode["file"] = $file;
				$episode["src"] = WEB_ROOT.substr($file, strlen(SYS_ROOT));
				$episode["title"] = $results[0];
				$episode["slug"] = $results[0];
				$episode["link"] = WEB_ROOT . "/watch/".$this->show->slug."/S".$this->index."/".$episode["slug"];
				return $episode;
			}
		}	
	}
}
?>