<?php
	
	require('parsedown.php');

	$parse = new Parsedown();

	$template = file_get_contents('template_baca.html');

	$articles = scandir('articles');

	unset($articles[0]);
	unset($articles[1]);

	foreach($articles as $art){
		$md = file_get_contents('articles/'.$art);
		// echo $parse->text($md);
		// $md = file_get_contents('articles/'.$art);

		$content = $parse->text($md);

		// echo $content;
		$exp = explode('</h1>', $content);
		$title = str_replace('<h1>','',$exp[0]);


		$html = $template;

		$html = str_replace('{{title}}', ucwords($title), $html);
		$html = str_replace('{{content}}', $content, $html);

		$filename = $title;
		$filename = preg_replace('/[^A-Za-z0-9- ]/', '', $filename);
		$filename = strtolower(str_replace('+','-',urlencode($filename)));
		$filename = $filename.'.html';
		// echo $title.'<br/>';
		// echo $art.'=== '.$filename.'<br/>';

		$url = 'http://notaduit.com/baca/'.$filename;
		$html = str_replace('{{url}}', ucwords($url), $html);

		file_put_contents('baca/'.$filename, $html);
	}

?>

Done!

