<?PHP
	require 'includes/master.inc.php';
	
	$a = new KBArticle($_GET['id']);
	if(!$a->ok()) redirect('/');
	
	$a->views++;
	$a->update();
	
	$s = new KBSection($a->section_id);
	
	$title = $a->title . ' | Click On Tyler Support';
?>
<?PHP include('inc/header.inc.php'); ?>
			<ul class="breadcrumb">
				<li><a href="/">Home</a> <span class="divider">/</span></li>
				<li><a href="/s/<?PHP echo $s->id; ?>/"><?PHP echo $s->title; ?></a> <span class="divider">/</span></li>
				<li class="active"><?PHP echo $a->title; ?></li>
			</ul>
        </div>
        <div class="row">
          <div class="span10">
			<h2><?PHP echo $a->title; ?></h2>
			<h6>Last Updated <?PHP echo dater($a->dt_modified, 'F j, Y'); ?></h6>
			<br>
			
			<?PHP echo Markdown($a->body); ?>
			
          </div>
          <div class="span4">
<?PHP include('inc/sidebar.inc.php'); ?>
        </div>
      </div>
    </div>
<?PHP include('inc/footer.inc.php'); ?>