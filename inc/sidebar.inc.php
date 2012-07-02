<?PHP
	$recent_articles = DBObject::glob('KBArticle', "SELECT * FROM kb_articles ORDER BY dt_modified DESC LIMIT 5");
?>

<h3>Search</h3>
<form action="search.php" method="get">
	<input type="text" name="q" id="q" value="">
</form>

<?PHP if(strpos($_SERVER['PHP_SELF'], 'article.php') === false) : ?>
<h3>Recently Updated</h3>
<ul>
	<?PHP foreach($recent_articles as $a) : ?>
	<li>
		<a href="/a/<?PHP echo $a->url(); ?>"><?PHP echo $a->title; ?></a>
		<?PHP echo dater($a->dt_modified, 'n/j'); ?>
	</li>
	<?PHP endforeach; ?>
</ul>
<?PHP endif; ?>

<h3>Contact Us</h3>
<p><strong>Email:</strong> <a href="mailto:support@clickontyler.com">support@clickontyler.com</a></p>
<p><strong>Phone:</strong> 800.939.9054<br>(We're a company of one person, so you'll probably have to leave a message. But we'll call you back.)</p>
<p><strong>Post:</strong> Click On Tyler<br>PO Box 680756<br>Franklin, TN 37068<br>United States</p>
