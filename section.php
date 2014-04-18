<?PHP
	require 'includes/master.inc.php';

	$s = new KBSection($_GET['id']);
	if(!$s->ok()) redirect('/');
	
	$title = $s->title . ' | Click On Tyler Support';

	if(isset($_GET['sort'])) {
		if($_GET['sort'] == 'recent') {
			$sort = 'recent';
			$articles = $s->mostRecentArticles();
		} else if($_GET['sort'] == 'popular') {
			$sort = 'popular';
			$articles = $s->mostPopularArticles();		
		} else if($_GET['sort'] == 'alpha') {
			$sort = 'alpha';
			$articles = $s->alphabeticalArticles();
		} else {
			$sort = 'popular';
			$articles = $s->mostPopularArticles();
		}
	} else {
		$sort = 'popular';
		$articles = $s->mostPopularArticles();
	}
?>
<?PHP include('inc/header.inc.php'); ?>
			<ul class="breadcrumb">
				<li><a href="/">Home</a> <span class="divider">/</span></li>
				<li class="active"><?PHP echo $s->title; ?></li>
			</ul>
        </div>
        <div class="row">
          <div class="span10">	
			<h2><a href="/s/<?PHP echo $s->id; ?>/"><?PHP echo $s->title; ?></a></h2>
			<p>
				<?PHP if($sort == 'recent') echo '&bull;'; ?>
				<a href="/s/<?PHP echo $s->id; ?>/recent">Recently Updated</a> | 
				<?PHP if($sort == 'popular') echo '&bull;'; ?>
				<a href="/s/<?PHP echo $s->id; ?>/popular">Most Popular</a> |
				<?PHP if($sort == 'alpha') echo '&bull;'; ?>
				<a href="/s/<?PHP echo $s->id; ?>/alpha">Alphabetical</a>
			</p>
			<ul>
				<?PHP foreach($articles as $a) : ?>
				<?PHP if($a->pinned == '1') : ?>
				<li><strong><a href="/a/<?PHP echo $a->url(); ?>"><?PHP echo $a->title; ?></a></strong></li>
				<?PHP else : ?>
				<li><a href="/a/<?PHP echo $a->url(); ?>"><?PHP echo $a->title; ?></a></li>				
				<?PHP endif; ?>
				<?PHP endforeach; ?>
			</ul>
          </div>
          <div class="span4">
<?PHP include('inc/sidebar.inc.php'); ?>			
          </div>
        </div>
      </div>

<?PHP include('inc/footer.inc.php'); ?>