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
			
			<hr>
			<hr>
			
			<div id="disqus_thread"></div>
	        <script type="text/javascript">
	            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	            var disqus_shortname = 'clickontylersupport'; // required: replace example with your forum shortname

	            /* * * DON'T EDIT BELOW THIS LINE * * */
	            (function() {
	                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
	                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
	                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	            })();
	        </script>
	        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
	        
			
          </div>
          <div class="span4">
<?PHP include('inc/sidebar.inc.php'); ?>
        </div>
      </div>
    </div>
<?PHP include('inc/footer.inc.php'); ?>