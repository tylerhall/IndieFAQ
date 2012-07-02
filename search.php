<?PHP
	require 'includes/master.inc.php';
	$title = 'Click On Tyler Support';

	$db      = Database::getDatabase();
	$q       = trim($_GET['q']);
	$_q      = $db->escape($q);
	$results = DBObject::glob('KBArticle', "SELECT * FROM kb_articles WHERE (title LIKE '%$_q%') OR (body LIKE '%$_q%') ORDER BY views DESC");
	
	$db->query("UPDATE kb_searches SET `count` = `count` + 1 WHERE q = '$_q'");
	if($db->affectedRows() == 0)
	{
		$db->query("INSERT INTO kb_searches (`q`, `count`) VALUES ('$_q', 1)");
	}
?>
<?PHP include('inc/header.inc.php'); ?>
		<ul class="breadcrumb">
			<li><a href="/">Home</a> <span class="divider">/</span></li>
			<li class="active">Search for <strong><?PHP echo $q; ?></strong></li>
		</ul>
        </div>
        <div class="row">
          <div class="span10">

			<h2>Search results for <strong><?PHP echo $q; ?></strong></h2>
			<ul>
				<?PHP foreach($results as $a) : ?>
				<li><a href="/a/<?PHP echo $a->url(); ?>"><?PHP echo $a->title; ?></a></li>
				<?PHP endforeach; ?>
			</ul>			
	
          </div>
          <div class="span4">
<?PHP include('inc/sidebar.inc.php'); ?>
          </div>
        </div>
      </div>
<?PHP include('inc/footer.inc.php'); ?>
