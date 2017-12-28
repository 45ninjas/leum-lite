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
	public $episodeTitles;

	public function GetEpisodes()
	{	
		$episodes = array();

		foreach (glob("$this->directory/*.$this->format") as $file)
		{
			$episode["file"] = $file;
			
			preg_match($this->regex, $file, $results);
			
			$episode["slug"] = $results[0];

			$episode["link"] = WEB_ROOT . "/watch/".$this->show->slug."/S".$this->index."/".$episode["slug"];

			if(isset($this->episodeTitles[$episode["slug"]]))
				$episode["title"] = $this->episodeTitles[$episode["slug"]];
			else
				$episode["title"] = $episode["slug"];

			$episodes[] = $episode;
		}
		return $episodes;
	}

	public function GetEpisode($slug)
	{
		$glob = glob($this->directory . "/*");
		$file;
		for ($i=0; $i < count($glob); $i++)
		{
			$file = $glob[$i];

			preg_match($this->regex, $file, $results);

			if($results[0] == $slug)
			{
				$episode["file"] = $file;
				$episode["src"] = WEB_ROOT.substr($file, strlen(SYS_ROOT));
				$episode["slug"] = $results[0];
				$episode["link"] = WEB_ROOT . "/watch/".$this->show->slug."/S".$this->index."/".$episode["slug"];

				if(isset($this->episodeTitles[$episode["slug"]]))
					$episode["title"] = $this->episodeTitles[$episode["slug"]];
				else
					$episode["title"] = $episode["slug"];

				if($i > 0)
				{
					preg_match($this->regex, $glob[$i - 1], $results);
					$episode["previous"] = $results[0];
				}

				if($i < count($glob) -1)
				{
					preg_match($this->regex, $glob[$i + 1], $results);
					$episode["next"] = $results[0];
				}
				return $episode;
			}
		}
	}
}
?>