<?PHP
	require 'includes/master.inc.php';
	
	$passwordIsCorrect = isset($_POST['password']) && ($_POST['password'] == Config::get('adminPassword')) ? true : false;

	if(isset($_GET['delete']) && $passwordIsCorrect)
	{
		$a = new KBArticle($_GET['delete']);
		$a->delete();
		redirect('admin.php');
	}

	if(isset($_POST['btnSubmit']) && $passwordIsCorrect)
	{		
		$a = new KBArticle($_POST['id']);
		$a->title      = $_POST['title'];
		$a->slug       = $_POST['slug'];
		$a->body       = $_POST['body'];
		$a->pinned     = isset($_POST['pinned']) ? 1 : 0;
		$a->published  = isset($_POST['published']) ? 1 : 0;
		$a->section_id = $_POST['section_id'];
		
		if($a->ok()) {
			$a->dt_modified = dater();
			$a->update();
		}
		else {
			$a->dt_created = dater();
			$a->dt_modified = dater();
			$a->insert();
		}

		redirect('admin.php?id=' . $a->id);
	}
	else if(isset($_GET['id']))
	{
		$a = new KBArticle($_GET['id']);
		$id         = $a->id;
		$title      = $a->title;
		$slug       = $a->slug;
		$body       = $a->body;
		$pinned     = $a->pinned;
		$published  = $a->published;
		$section_id = $a->section_id;
	}
	else
	{
		$id         = '';
		$title      = '';
		$slug       = '';
		$body       = '';
		$pinned     = 0;
		$published  = 0;
		$section_id = 0;
	}
	
	$password = isset($_POST['password']) ? $_POST['password'] : '';

	$articles = DBObject::glob('KBArticle', "SELECT * FROM kb_articles ORDER BY dt_modified DESC");
	$sections = DBObject::glob('KBSection', "SELECT * FROM kb_sections ORDER BY title");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>IndieFAQ Admin</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <link rel="stylesheet" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
	<style type="text/css" media="screen">
	html, body { background-color:#666; color:#222; }

	/* Make the page full bleed */
	#doc3 { margin:0; }

	/* Header */
	#hd { padding:1.2em 1.5em 0 1.5em; background-color:#7a1818; }
	h1 { font-size:230%; color:#fff; }

	#navigation { margin-top:1.5em; background-color:#262626; height:1%; }
	#navigation li { float:left; display:inline; }
	#navigation li a { display:block; color:#fff; text-decoration:none; }
	#navigation li a:hover { text-decoration:underline; }

	#primary-navigation li a { font-size:116%; padding:0.4em 1em; }
	#primary-navigation li.active a { background-color:#f0f0ee; color:#000; }
	#primary-navigation li.highlight a { background-color:lightyellow; color:#000; }

	#user-navigation { float:right; }
	#user-navigation li a { font-size:93%; padding:0.5em 1em; }

	/* Body */
	#bd { padding:1.5em; }
	h2 { font-size:153.9%; margin-bottom:0.5em; }
	h3 { font-size:153.9%; margin-bottom:0.5em; }

	/* Basic block */
	.block { margin-bottom:1.5em; }
	.block .hd { background-color:#7a1818; padding:0.7em 1em; color:#fff; border-bottom:10px solid #262626; }
	.block .hd h2, .block .hd h3 { font-size:100%; margin-bottom:0; }
	.block .hd a { color:#fff; }
	.block .bd { padding:1em; background-color:#fff; }
	.block .bd h2 { color:#7a1818; }
	.block .bd h3 { color:#7a1818; }

	/* Extend block with tabs */
	.tabs .hd { padding:0; }
	.tabs .hd ul { height:1%; }
	.tabs .hd ul li { float:left; }
	.tabs .hd ul li a { display:block; color:#fff; text-decoration:none; padding:0.5em 1em; }
	.tabs .hd ul li a:hover { background-color:#470E0E; }
	.tabs .hd ul li.active a { background-color:#262626 !important; color:#fff; text-decoration:none; } /* important! fixes IE cascade issue */
	.tabs .hd h2, .tabs .hd h3 { position:absolute; margin-left:-5000px; } /* Hidden SEO Header if needed */

	/* Extend tab block with spaced tabs */
	.spaces .hd { background-color:transparent; }
	.spaces .hd ul li { background-color:#7a1818; margin-right:0.1em; }

	/* Extend block and header to have rounded corners */
	.rounded .hd,
	.rounded .hd ul li,
	.rounded .hd ul li a,
	.rounded #navigation,
	.rounded #navigation ul li,
	.rounded #navigation ul li a {
	    -moz-border-radius-topright:7px;
	    -moz-border-radius-topleft:7px;
	    -webkit-border-top-right-radius:7px;
	    -webkit-border-top-left-radius:7px;
	}

	/* Style the horizontal rules inside .block */
	.block hr { background-color:#f0f0ee; color:#f0f0ee; height:1px; border:0; }

	/* Tables */
	table { width:100%; margin-bottom:2em; }
	table td, table th { padding:0.5em; }
	table thead { background-color:#262626; color:#fff; font-weight:bold; }
	table thead a { text-decoration:none; color:#fff; }
	table thead a:hover { text-decoration:underline; }
	table tbody tr:hover { background-color:#ccc; }
	table tbody tr.new { background-color:#d0adad; }
	table tbody a { text-decoration:underline; }

	/* Pager control*/
	ul.pager { text-align:left; margin-bottom:1em; }
	ul.pager li { float:left; margin-bottom:1em; }
	ul.pager li a { padding:0.1em 0.3em; margin-right:0.3em; border:1px solid #000; text-decoration:none; color:#000; }
	ul.pager li.active a, ul.pager li a:hover { background-color:#000; color:#fff; }

	/* Forms */
	form label { font-weight:bold; }
	form label span { font-weight:normal; color:#f00; font-size:85%; }
	form span.info { font-style:italic; color:#aaa; font-size:85%; }
	form .text { display:block; width:99%; border:1px solid #aaa; padding:0.3em; }
	form .column { width:48%; }
	form .left { float:left; }
	form .right { float:right; }

	/* Messages */
	.alert { padding:0.5em; text-align:center; }
	.error { border:2px solid #fbb; background-color:#fdd; }
	.warning { border:2px solid #fffaaa; background-color:#ffc; }
	.notice { border:2px solid #1fdf00; background-color:#bbffb6; }

	/* Lists */
	ol.list, ul.list, dl.list { margin-left:2em; margin-bottom:1em; }
	ol.list li { list-style:decimal outside; }
	ul.list li { list-style:disc outside; }
	dl.list dd { margin-left:1em; }

	ul.biglist { margin-bottom:1em; }
	ul.biglist li { margin-top:-1px; border:1px solid #f0f0ee; border-width:1px 0 1px 0; }
	ul.biglist li a { display:block; padding:0.5em 0; text-decoration:none; color:#000; }
	ul.biglist li a:hover { text-decoration:underline; }

	/* Footer */
	#ft { text-align:center; font-size:85%; padding:0.5em 1em; color:#262626; }

	/* Generics */
	p { margin-bottom:1em; }
	a { color:#7a1818; }
	strong { font-weight:bold; }
	em { font-style:italic; }
	abbr, acronym { border-bottom:1px dotted #000; cursor:help; }
	textarea { height:13em; }

	.small { font-size:85%; }
	.gray { color:#999; }
	.highlight { background-color:#ffffcc; }
	.clear { clear:both; }
	.text-left { text-align:left; }
	.text-right { text-align:right; }
	.text-center { text-align:center; }
	.inline { display:inline; }
	.dim { opacity:0.3; }
	.fraud { background-color:yellow; }

	/* Shine Specific Stuff */
	a.big-button {
		display:block; border:1px solid #999; color:#000; text-decoration:none; padding:0.5em 1em;
		-moz-border-radius:7px; -webkit-border-radius:7px;
		background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0, rgb(250,250,250)),color-stop(0.5, rgb(220,220,220)));
		background:-moz-linear-gradient(center top,rgb(250,250,250) 0%,rgb(220,220,220) 50%);
	}
	a.big-button:hover {
		background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0, rgb(230,230,230)),color-stop(0.5, rgb(200,200,200)));
		background:-moz-linear-gradient(center top,rgb(230,230,230) 0%,rgb(200,200,200) 50%);
	}

	.bd div.ticket { background-color:#edd; margin:-1em; margin-bottom:1em; padding:1em; border-bottom:1px solid #ccc; }
	.bd div.ticket img { float:left; margin:0 1em 1em 0; }
	.bd div.ticket h3 { font-weight:bold; color:#000; margin-bottom:0; font-size:138.5%; }
	.bd div.ticket .meta { color:#666; }
	.bd div.ticket .float-box { float:right; text-align:center; background-color:#ccc; font-weight:bold; padding:0.5em; font-size:123.1%;  -moz-border-radius:7px; -webkit-border-radius:7px; border:1px solid #aaa; }
	.bd div.ticket .float-box span { font-size:77%; }
	.bd div.ticket h4 { font-size:108%; font-weight:bold; }
	.bd div.ticket .markdown { clear:both; }

	.chart {
		width:100%;
		height:200px;
	}

	table.lines tr {
		border-bottom:1px solid #F0F0EE;
	}
	</style>
</head>
<body class="rounded">
    <div id="doc3" class="yui-t6">
        <div id="bd">
            <div id="yui-main">
                <div class="yui-b"><div class="yui-g">

                    <div class="block">
                        <div class="hd">
                            <h2>New / Edit Article</h2>
							<div class="clear"></div>
                        </div>
                        <div class="bd">
							<form action="admin.php" method="POST" accept-charset="utf-8">
								<p><label for="title">Title</label> <input type="text" name="title" id="title" value="<?PHP echo htmlspecialchars($title);?>" class="text"></p>
								<p><label for="slug">Article Slug</label> <input type="text" name="slug" id="slug" value="<?PHP echo $slug;?>" class="text"></p>
								<p>
									<label for="body">Article Body</label>
                                    <textarea name="body" id="body" class="text"><?PHP echo $body; ?></textarea>
                                </p>
								<p><input type="checkbox" name="published" value="1" id="published" <?PHP if($published) echo 'checked="checked"'; ?>> <label for="published">Published?</label></p>
								<p><input type="checkbox" name="pinned" value="1" id="pinned" <?PHP if($pinned) echo 'checked="checked"'; ?>> <label for="pinned">Pinned?</label></p>
								<p><label for="section">Section</label>
									<select name="section_id" id="section_id">
										<?PHP foreach($sections as $s) : ?>
										<option value="<?PHP echo $s->id; ?>" <?PHP if($s->id == $section_id) echo 'selected="selected"'; ?>><?PHP echo $s->title; ?></option>
										<?PHP endforeach; ?>
									</select>
								</p>
								<p><label for="password">Password</label> <input type="text" name="password" id="password" value="<?PHP echo $password;?>" class="text"></p>
								<p><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit"></p>
								<input type="hidden" name="id" value="<?PHP echo $id; ?>" id="id">
							</form>
						</div>
					</div>

                    <div class="block">
                        <div class="hd">
                            <h2>Articles</h2>
							<div class="clear"></div>
                        </div>
                        <div class="bd">
                            <table class="lines">
                                <thead>
                                    <tr>
										<td>Title</td>
										<td>Modified</td>
										<td>Published</td>
										<td>Pinned</td>
										<td>&nbsp;</td>
                                    </tr>
                                </thead>
                                <tbody>
									<?PHP foreach($articles as $a) : ?>
									<tr>
										<td><a href="admin.php?id=<?PHP echo $a->id; ?>"><?PHP echo $a->title; ?></a></td>
										<td><?PHP echo dater($a->dt_modified); ?></td>
										<td><?PHP echo $a->published ? 'Yes' : 'No'; ?></td>
										<td><?PHP echo $a->pinned ? 'Yes' : 'No'; ?></td>
										<td><a href="admin.php?delete=<?PHP echo $a->id; ?>">Delete</a></td>
									</tr>
									<?PHP endforeach; ?>
                                </tbody>
                            </table>
						</div>
					</div>
              
                </div></div>
            </div>
            <div id="sidebar" class="yui-b">

            </div>
        </div>

        <div id="ft"></div>
    </div>
</body>
</html>
