<?php

/*
	@abstract Print or return note as HTML element incl. stylesheet
	@example  html_note('Lorem Ipsum Dolore', 'adilbo', false)
	@param    string $content [default=favicon.png]
	@param    string $footer [default='']
	@param    bool $echo [default=true]
	@return   echo OR string $html
	@link     -
	@todo     -
	@version  2.0
*/

if(basename(__FILE__)==basename($_SERVER['PHP_SELF']))
	html_note('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.', 'adilbo', true);

function html_note($content, $footer='', $echo=true){
	$return = '
	<style>
		.notepaper,
		blockquote,
		figure {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline
		}
		.notepaper {
			font: 12px/20px "Lucida Grande",Tahoma,Verdana,sans-serif;
			color:#404040;
			background:#dce1e1;
			position: relative;
			margin: 30px auto;
			padding: 29px 20px 20px 45px;
			width: 280px;
			line-height: 30px;
			color: #6a5f49;
			text-shadow: 0 1px 1px #fff;
			background-color: #f2f6c1;
			background-image: -webkit-radial-gradient(center, cover, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0.1) 90%), -webkit-repeating-linear-gradient(top, transparent 0%, transparent 29px, rgba(239, 207, 173, 0.7) 29px, rgba(239, 207, 173, 0.7) 30px);
			background-image: -moz-radial-gradient(center, cover, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0.1) 90%), -moz-repeating-linear-gradient(top, transparent 0%, transparent 29px, rgba(239, 207, 173, 0.7) 29px, rgba(239, 207, 173, 0.7) 30px);
			background-image: -o-radial-gradient(center, cover, rgba(255, 255, 255, 0.7) 0%, rgba(255, 255, 255, 0.1) 90%), -o-repeating-linear-gradient(top, transparent 0%, transparent 29px, rgba(239, 207, 173, 0.7) 29px, rgba(239, 207, 173, 0.7) 30px);
			border: 1px solid #c3baaa;
			border-color: rgba(195, 186, 170, 0.9);
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), inset 0 0 5px #d8e071, 0 0 1px rgba(0, 0, 0, 0.1), 0 2px rgba(0, 0, 0, 0.02);
			box-shadow: inset 0 1px rgba(255, 255, 255, 0.5), inset 0 0 5px #d8e071, 0 0 1px rgba(0, 0, 0, 0.1), 0 2px rgba(0, 0, 0, 0.02)
		}
		.notepaper:before,
		.notepaper:after {
			content: "";
			position: absolute;
			top: 0;
			bottom: 0;
		}
		.notepaper:before {
			left: 28px;
			width: 2px;
			border: solid #efcfad;
			border-color: rgba(239, 207, 173, 0.9);
			border-width: 0 1px;
		}
		.notepaper:after {
			z-index: -1;
			left: 0;
			right: 0;
			background: rgba(242, 246, 193, 0.9);
			border: 1px solid rgba(170, 157, 134, 0.7);
			-webkit-transform: rotate(2deg);
			-moz-transform: rotate(2deg);
			-ms-transform: rotate(2deg);
			-o-transform: rotate(2deg);
			transform: rotate(2deg);
		}
		.quote {
			font-family: Georgia, serif;
			font-size: 14px;
		}
		.quotes:before,
		.quotes:after {
			display: inline-block;
			vertical-align: top;
			height: 30px;
			line-height: 48px;
			font-size: 50px;
			opacity: .2;
		}
		.quotes:before {
			content: "\201C";
			margin-right: 4px;
			margin-left: -8px;
		}
		.quotes:after {
			content: "\201D";
			margin-left: 4px;
			margin-right: -8px;
		}
		.quote-by {
			display: block;
			padding-right: 10px;
			text-align: right;
			font-size: 13px;
			font-style: italic;
			color: #84775c;
		}
		.lt-ie8 .notepaper {
			padding: 15px 25px
		}
		::-moz-selection {
			text-shadow: none;
			background: #FF0039;
			color: #fff;
		}
		::selection {
			text-shadow: none;
			background: #FF0039;
			color: #fff;
		}
	</style>
	<div class="notepaper">
		<figure class="quote">
			<blockquote class="quotes">
			'.$content.'
			</blockquote>
			<figcaption class="quote-by">
			'.$footer.'
			</figcaption>
		</figure>
	</div>
	';
	if($echo) {
		echo $return;
	}
	return $return;
}
