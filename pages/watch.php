<?php 
include_once "src/show.php";
class Watch
{
	public $show;
	public $episode;
	function __construct($media, $args)
	{
		$this->show = LoadShow($args[0]);
		$seasonIndex = substr($args[1], 1) - 1;
		$episodeSlug = $args[2];

		$this->episode = $this->show->GetEpisode($seasonIndex, $episodeSlug);

		$media->title = $this->show->title;
	}
	function Render()
	{
		?>
		<video controls="yes" src="<?php echo $this->episode["src"]; ?>">
		</video>
		<?php
	}
}
 ?>