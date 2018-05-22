<?php

/*
	@abstract Converts a binary file or a text file to an php file
	@example  file_bin2php('http://www.famfamfam.com/lab/icons/mini/icons/icon_alert.gif','./test/example.php')
	@param    string $input_file
	@param    string $output_file [optional]
	@return   string $PHP_Code
	@link     http://php.net/manual/en/function.phpinfo.php
	@todo     -
	@version  3.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))echo '<xmp>'.file_bin2php('http://www.famfamfam.com/lab/icons/mini/icons/icon_alert.gif').'</xmp>';

function file_bin2php($file, $output_file=''){
	$i = file_get_contents($file);
	$b = array();
	$x = 0; 
	$y = 1;
	for ($c=0; $c < strlen($i); $c++){
		$no = bin2hex($i[$c]);
		$b[$x] = isset($b[$x]) ? $b[$x].'\\x'.$no : '\\x'.$no;
		if ($y >= 10){ 
			$x++; 
		$y = 0;
		}
		$y++;
	}
	$mimeTypes = array(
		// Image formats
		'jpg'                          => 'image/jpeg',
		'jpeg'                         => 'image/jpeg',
		'jpe'                          => 'image/jpeg',
		'gif'                          => 'image/gif',
		'png'                          => 'image/png',
		'bmp'                          => 'image/bmp',
		'tif'                          => 'image/tiff',
		'tiff'                         => 'image/tiff',
		'ico'                          => 'image/x-icon',
		// Video formats
		'asf'                          => 'video/x-ms-asf',
		'asx'                          => 'video/x-ms-asf',
		'wmv'                          => 'video/x-ms-wmv',
		'wmx'                          => 'video/x-ms-wmx',
		'wm'                           => 'video/x-ms-wm',
		'avi'                          => 'video/avi',
		'divx'                         => 'video/divx',
		'flv'                          => 'video/x-flv',
		'mov'                          => 'video/quicktime',
		'qt'                           => 'video/quicktime',
		'mpeg'                         => 'video/mpeg',
		'mpg'                          => 'video/mpeg',
		'mpe'                          => 'video/mpeg',
		'mp4'                          => 'video/mp4',
		'm4v'                          => 'video/mp4',
		'ogv'                          => 'video/ogg',
		'webm'                         => 'video/webm',
		'mkv'                          => 'video/x-matroska',
		// Text formats
		'txt'                          => 'text/plain',
		'asc'                          => 'text/plain',
		'c'                            => 'text/plain',
		'cc'                           => 'text/plain',
		'h'                            => 'text/plain',
		'csv'                          => 'text/csv',
		'tsv'                          => 'text/tab-separated-values',
		'ics'                          => 'text/calendar',
		'rtx'                          => 'text/richtext',
		'css'                          => 'text/css',
		'htm'                          => 'text/html',
		'html'                         => 'text/html',
		// Audio formats
		'mp3'                          => 'audio/mpeg',
		'm4a'                          => 'audio/mpeg',
		'm4b'                          => 'audio/mpeg',
		'ra'                           => 'audio/x-realaudio',
		'ram'                          => 'audio/x-realaudio',
		'wav'                          => 'audio/wav',
		'ogg'                          => 'audio/ogg',
		'oga'                          => 'audio/ogg',
		'mid'                          => 'audio/midi',
		'midi'                         => 'audio/midi',
		'wma'                          => 'audio/x-ms-wma',
		'wax'                          => 'audio/x-ms-wax',
		'mka'                          => 'audio/x-matroska',
		// Misc application formats
		'rtf'                          => 'application/rtf',
		'js'                           => 'application/javascript',
		'pdf'                          => 'application/pdf',
		'swf'                          => 'application/x-shockwave-flash',
		'class'                        => 'application/java',
		'tar'                          => 'application/x-tar',
		'zip'                          => 'application/zip',
		'gz'                           => 'application/x-gzip',
		'gzip'                         => 'application/x-gzip',
		'rar'                          => 'application/rar',
		'7z'                           => 'application/x-7z-compressed',
		'exe'                          => 'application/x-msdownload',
		// MS Office formats
		'doc'                          => 'application/msword',
		'pot'                          => 'application/vnd.ms-powerpoint',
		'pps'                          => 'application/vnd.ms-powerpoint',
		'ppt'                          => 'application/vnd.ms-powerpoint',
		'wri'                          => 'application/vnd.ms-write',
		'xla'                          => 'application/vnd.ms-excel',
		'xls'                          => 'application/vnd.ms-excel',
		'xlt'                          => 'application/vnd.ms-excel',
		'xlw'                          => 'application/vnd.ms-excel',
		'mdb'                          => 'application/vnd.ms-access',
		'mpp'                          => 'application/vnd.ms-project',
		'docx'                         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'docm'                         => 'application/vnd.ms-word.document.macroEnabled.12',
		'dotx'                         => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
		'dotm'                         => 'application/vnd.ms-word.template.macroEnabled.12',
		'xlsx'                         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'xlsm'                         => 'application/vnd.ms-excel.sheet.macroEnabled.12',
		'xlsb'                         => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
		'xltx'                         => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
		'xltm'                         => 'application/vnd.ms-excel.template.macroEnabled.12',
		'xlam'                         => 'application/vnd.ms-excel.addin.macroEnabled.12',
		'pptx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		'pptm'                         => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
		'ppsx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
		'ppsm'                         => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
		'potx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.template',
		'potm'                         => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
		'ppam'                         => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
		'sldx'                         => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
		'sldm'                         => 'application/vnd.ms-powerpoint.slide.macroEnabled.12',
		'onetoc'                       => 'application/onenote',
		'onetoc2'                      => 'application/onenote',
		'onetmp'                       => 'application/onenote',
		'onepkg'                       => 'application/onenote',
		// OpenOffice formats
		'odt'                          => 'application/vnd.oasis.opendocument.text',
		'odp'                          => 'application/vnd.oasis.opendocument.presentation',
		'ods'                          => 'application/vnd.oasis.opendocument.spreadsheet',
		'odg'                          => 'application/vnd.oasis.opendocument.graphics',
		'odc'                          => 'application/vnd.oasis.opendocument.chart',
		'odb'                          => 'application/vnd.oasis.opendocument.database',
		'odf'                          => 'application/vnd.oasis.opendocument.formula',
		// WordPerfect formats
		'wp'                           => 'application/wordperfect',
		'wpd'                          => 'application/wordperfect',
		// iWork formats
		'key'                          => 'application/vnd.apple.keynote',
		'numbers'                      => 'application/vnd.apple.numbers',
		'pages'                        => 'application/vnd.apple.pages',
	);
	$fileExtension = substr(strrchr($file, '.'), 1);
	$mime_content_type = isset($mimeTypes[$fileExtension]) ? $mimeTypes[$fileExtension] : "application/octet-stream";
	$output = '<'."?php\n";
	#$output .= "header('Content-type: ".@mime_content_type($file)."');\n"; // deprecated
	$output .= "header('Content-type: ".$mime_content_type."');\n";
	$output .= '$f ="';
	$output .= implode("\";\r\n\$f.=\"", $b);
	$output .= "\";\nprint \$f;";
	$output .= "\n?>";
	if($output_file!='' and $fp = fopen($output_file, 'w')){
		fwrite($fp, $output);
		fclose($fp);
		$output = true;
	}elseif($output_file!=''){
		$output = false;
	}
	return $output;
}
