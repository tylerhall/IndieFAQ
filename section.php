<?PHP
	require 'includes/master.inc.php';
	
	$s = new KBSection($_GET['id']);
	if(!$s->ok()) redirect('/');
	
	$title = $s->title . ' | Click On Tyler Support';
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
			<ul>
				<?PHP foreach($s->articles() as $a) : ?>
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