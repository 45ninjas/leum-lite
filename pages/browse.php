<?php 

require_once "src/show.php";

class Browse
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
					<h1 class="title">SAM-PC TV Shows</h1>
					<h2 class="subtitle">Ask Tom about it.</h2>
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
		<section class="show-hero hero is-medium is-primary is-bold" style="background-image: url('<?php echo $show->heroImg; ?>');">
			<div class="hero-body">
				<div class="container">
					<h1 class="title"><?php echo $show->title; ?></h1>
					<h2 class="subtitle"><?php $this->SubTitle(); ?></h2>
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

					<ul class="episode-list">
					<?php
						foreach($season->GetEpisodes() as $episode)
						{
							echo "<a class=\"button\" href=" . $episode["link"] . "><li>" . $episode["title"] . "</li></a><br>";
						}
					?>
					</ul>
				</div>
			</section>
			<?php
		}
	}
	function SubTitle()
	{
		$totalSeasons = count($this->shows->seasons);
		echo "$totalSeasons Seasons";
	}
	function Render()
	{
		if($this->singular)
			$this->ListShow();
		else
			$this->ListShows();
	}
}
 ?>