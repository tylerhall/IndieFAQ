<?PHP
	require 'includes/master.inc.php';
	
	$sections = DBObject::glob('KBSection', "SELECT * FROM kb_sections ORDER BY title");
	$sections = array_values($sections);
	
	$title = 'Click On Tyler Support';
?>
<?PHP include('inc/header.inc.php'); ?>
        </div>
        <div class="row">
          <div class="span10">
			<?PHP foreach($sections as $s) : ?>
			<h2><a href="/s/<?PHP echo $s->id; ?>/"><?PHP echo $s->title; ?></a></h2>
			<?PHP $full_articles = $s->articles(); ?>
			<?PHP $articles = array_slice($full_articles, 0, 5); ?>
			<ul>
				<?PHP foreach($articles as $a) : ?>
				<li><a href="/a/<?PHP echo $a->url(); ?>"><?PHP echo $a->title; ?></a></li>
				<?PHP endforeach; ?>
			</ul>
			<p><span style=""><a href="/s/<?PHP echo $s->id; ?>/">View all <?PHP echo count($full_articles); ?> articles &#187;</a></span></p>
			<br>
			<?PHP endforeach; ?>
          </div>
          <div class="span4">
<?PHP include('inc/sidebar.inc.php'); ?>
          </div>
        </div>
      </div>
<?PHP include('inc/footer.inc.php'); ?>