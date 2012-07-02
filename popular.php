<?PHP
	require 'includes/master.inc.php';
	
	$title = 'Most Viewed Articles | Click On Tyler Support';
	
	$db       = Database::getDatabase();
	$articles = DBObject::glob('KBArticle', "SELECT * FROM kb_articles ORDER BY views DESC");
	$searches = $db->getRows("SELECT q, `count` FROM kb_searches WHERE `count` > 5 ORDER BY `count` DESC LIMIT 10");
?>
<?PHP include('inc/header.inc.php'); ?>
			<ul class="breadcrumb">
				<li><a href="/">Home</a> <span class="divider">/</span></li>
				<li class="active">Most Viewed Articles</li>
			</ul>
        </div>
        <div class="row">
          <div class="span10">	
			<h2><a href="/popular.php">Most Viewed Articles</a></h2>
			<ul>
				<?PHP foreach($articles as $a) : ?>
				<li><a href="/a/<?PHP echo $a->url(); ?>"><?PHP echo $a->title; ?></a> (<?PHP echo $a->views; ?> views)</li>
				<?PHP endforeach; ?>
			</ul>
			
			<h2><a href="/popular.php">Most Popular Searches</a></h2>
			<ul>
				<?PHP foreach($searches as $s) : ?>
				<li><a href="/serach.php?q=<?PHP echo $s['q']; ?>"><?PHP echo $s['q']; ?></a> (<?PHP echo $s['count']; ?> views)</li>
				<?PHP endforeach; ?>
			</ul>
          </div>
          <div class="span4">
<?PHP include('inc/sidebar.inc.php'); ?>			
          </div>
        </div>
      </div>

<?PHP include('inc/footer.inc.php'); ?>
