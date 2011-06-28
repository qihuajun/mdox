<?php
declare(encoding='UTF-8');

// File manipulation methods
function mdox_append_ext($file, $ext) {
	return (implode('.', array($file, $ext)));
}

function mdox_compress_css($css_file) {
	$css_file = CSS_DIR.$css_file;
	
	$css = null;
	if (is_file($css_file)) {
		$css = file_get_contents($css_file);
		$css = preg_replace('#/\*.*\*/#isU', '', $css);
		$css = str_replace(array("\t", "\r", "\r\n", "\n"), '', $css);
	}
	
	return $css;
}

function mdox_create_title_from_filename($file) {
	$basefile = basename($file);
	$plainfile = mdox_remove_ext($basefile);
	$title = ucwords(str_replace('-', '. ', $plainfile));
	
	return $title;
}

function mdox_remove_ext($file) {
	$plainfile = preg_replace('/(\.[a-z0-9]+)$/i', '', $file);
	
	return $plainfile;
}

function mdox_render_template($template, $variables=array()) {
	$replace_variables = array();
	
	$template = TEMPLATE_DIR.$template;
	if (!is_file($template)) {
		return null;
	}
	
	// Format the variables
	foreach ($variables as $key => $value) {
		$special_key = '{{'.$key.'}}';
		$replace_variables[$special_key] = $value;
	}
	
	$replace_keys = array_keys($replace_variables);
	
	$template_contents = file_get_contents($template);
	$template_contents = str_replace($replace_keys, $replace_variables, $template_contents);
	
	return $template_contents;
}

// General mdox functions
function mdox_read_config($src_input) {
	$config = array();
	$config_file = $src_input.'config.json';
	if (is_file($config_file)) {
		$config = json_decode(file_get_contents($config_file), true);
	}
	return $config;
}




function mdox_output($msg, $error=false) {
	$output_stream = STDOUT;
	if($error) {
		$output_stream = STDERR;
	}

	fwrite($output_stream, $msg.PHP_EOL);

	if ($error) {
		exit(1);
	}
}