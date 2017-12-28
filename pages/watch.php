<?php 
include_once "src/show.php";
class watch
{
	public $show;
	public $episode;
	public $episodeSeasonTitle;
	function __construct($media, $args)
	{
		$this->show = LoadShow($args[0]);
		$seasonIndex = substr($args[1], 1) - 1;
		$episodeSlug = $args[2];


		$this->episode = $this->show->GetEpisode($seasonIndex, $episodeSlug);

		$showTitle = $this->show->title;
		$media->title = "$showTitle - S" . ($seasonIndex + 1) . $episodeSlug;
		$this->episodeSeasonTitle = "Season " . ($seasonIndex + 1) . ", $episodeSlug";

	}
	function Render()
	{
		?>
		<section class="section">
			<div class="card container">
				<div class="card-image">
					<figure class="video is-16by9">
						<video class="player" controls="yes" src="<?php echo $this->episode["src"]; ?>">
						</video>
					</figure>
				</div>
				<div class="card-content">
					<div class="media">
						<div class="media-left">
							<figure class="image is-48x48">
								<img src="<?php echo $this->show->coverImg; ?>" alt="Placeholder image">
							</figure>
						</div>
						<div class="media-content columns">
							<div class="column">
								<a href="<?php echo WEB_ROOT . "/browse/" .$this->show->slug; ?>"><p class="title is-4"><?php echo $this->show->title; ?></p></a>
								<p class="subtitle is-6"><?php echo $this->episode["title"]; ?><br>
									<?php echo $this->episodeSeasonTitle; ?></p>
							</div>
							<div class="column player-nav">
								<?php $this->PrevButton();?>
								<?php $this->NextButton();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script type="text/javascript">
			
		</script>
		<?php
	}
	function PrevButton()
	{
		if(isset($this->episode["previous"]))
			$prev = $this->episode["previous"];
		?>
		
		<a <?php if(isset($prev)) echo "href=\"$prev\""; ?> <?php if(!isset($prev)) echo "disabled"; ?> class="button is-outlined is-link">
		    <span class="icon is-small">
		    	<i class="fa fa-chevron-left"></i>
		    </span>
			<span><?php if(isset($prev)) echo $prev; else echo "Prev."; ?></span>
		</a>
		<?php
	}
	function NextButton()
	{
		if(isset($this->episode["next"]))
			$next = $this->episode["next"];
		?>

		<a <?php if(isset($next)) echo "href=\"$next\""; ?> <?php if(!isset($next)) echo "disabled"; ?> class="button is-outlined is-link">
			<span><?php if(isset($next)) echo $next; else echo "Next"; ?></span>
		    <span class="icon is-small">
		    	<i class="fa fa-chevron-right"></i>
		    </span>
		</a>
		<?php
	}
}
 ?>