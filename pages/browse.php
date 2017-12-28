<?php 

require_once "src/show.php";

class browse
{
	public $shows;
	public $singular;
	function __construct($media, $args)
	{
		$media->title = "Browse Shows";
		if(isset($args) && count($args) > 0)
		{
			$this->singular = true;
			$this->shows = LoadShow($args[0]);
		}
		else
		{
			$this->singular = false;
			$this->shows = LoadShows();
		}
	}
	function ListShows()
	{
		?>
		<section class="hero is-primary is-bold">
			<div class="hero-body">
				<div class="container">
					<h1 class="title"><?php echo SITE_TITLE; ?></h1>
					<h2 class="subtitle"><?php echo SITE_SUBTITLE; ?></h2>
				</div>
			</div>
		</section>
		<section class="section">
			<div class="container">
				<div class="shows columns">
				<?php foreach ($this->shows as $show)
				{
					?>
					<a class="box column is-3" href="browse/<?php echo $show->slug; ?>">
						<img src="<?php echo $show->coverImg; ?>">
					</a>
					<?php				
				}
				?>
			</div>
		</div>
		</section>
		<?php
	}
	function ListShow()
	{
		$show = $this->shows;
		?>
		<section class="hero is-large is-bold show-hero" <?php $this->HeroImage($show); ?>>
			<div class="hero-body">
				<div class="container">
					<h1 class="title"><?php echo $show->title; ?></h1>
					<figure class="image is-128x128">
						<img src="<?php echo $show->coverImg ?>">						
					</figure>
				</div>
			</div>
		</section>
		<?php
		foreach ($show->seasons as $season)
		{
			?>
			<section class="section">
				<div class="container">
					<h1 class="title"><?php echo $season->title; ?></h1>
					<h1 class="subtitle"><?php echo "$season->quality, $season->format"; ?></h1>
					<hr>

					<ol class="episode-list">
					<?php
						foreach($season->GetEpisodes() as $episode)
						{
							echo "<li><a href=" . $episode["link"] . ">" . $episode["title"] . "</a></li>";
						}
					?>
					</ol>
				</div>
			</section>
			<?php
		}
	}
	function Render()
	{
		if($this->singular)
			$this->ListShow();
		else
			$this->ListShows();
	}
	function HeroImage($show)
	{
		if(count($show->heroImgs) > 0)
		{
			$hero = $show->heroImgs[array_rand($show->heroImgs)];
		 	echo "style=\"background-image: url('$hero');\"";
		}
	}
}
 ?>