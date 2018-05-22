<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tumel
 * Date: 5/20/2018
 * Time: 12:00 AM
 */

Class Sanity
{

    private $ci;


    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->library('encrypt');
        $this->ci->load->library('email');
        $this->ci->load->helper('cookie');
        $this->ci->load->helper('url');
    }
    public function secure_requests()
    {
        if (preg_match("/^(HEAD|TRACE|TRACK|DEBUG|OPTIONS)/i", $_SERVER['REQUEST_METHOD']))
            {
                redirect('landing/error/ole');
            }

        $_REQUEST_URI = urldecode($_SERVER['REQUEST_URI']);
        if (preg_match("/(<|%3C)([^s]*s)+cript.*(>|%3E)/i", $_REQUEST_URI) ||
            preg_match("/(<|%3C)([^e]*e)+mbed.*(>|%3E)/i", $_REQUEST_URI) ||
            preg_match("/(<|%3C)([^o]*o)+bject.*(>|%3E)/i", $_REQUEST_URI) ||
            preg_match("/(<|%3C)([^i]*i)+frame.*(>|%3E)/i", $_REQUEST_URI) ||
            preg_match("/(<|%3C)([^o]*o)+bject.*(>|%3E)/i", $_REQUEST_URI) ||
            preg_match("/base64_(en|de)code[^(]*\([^)]*\)/i", $_REQUEST_URI) ||
            preg_match("/(%0A|%0D|\\r|\\n)/", $_REQUEST_URI) ||
            preg_match("/union([^a]*a)+ll([^s]*s)+elect/i", $_REQUEST_URI))
            {
                redirect('landing/error/ole');
            }
            else {

                $_QUERY_STRING = urldecode($_SERVER['QUERY_STRING']);
                if (preg_match("/(<|%3C)([^s]*s)+cript.*(>|%3E)/i", $_QUERY_STRING) ||
                    preg_match("/(<|%3C)([^e]*e)+mbed.*(>|%3E)/i", $_QUERY_STRING) ||
                    preg_match("/(<|%3C)([^o]*o)+bject.*(>|%3E)/i", $_QUERY_STRING) ||
                    preg_match("/(<|%3C)([^i]*i)+frame.*(>|%3E)/i", $_QUERY_STRING) ||
                    preg_match("/(<|%3C)([^o]*o)+bject.*(>|%3E)/i", $_QUERY_STRING) ||
                    preg_match("/base64_(en|de)code[^(]*\([^)]*\)/i", $_QUERY_STRING) ||
                    preg_match("/(%0A|%0D|\\r|\\n)/i", $_QUERY_STRING) ||
                    preg_match("/(\.\.\/|\.\.\\|%2e%2e%2f|%2e%2e\/|\.\.%2f|%2e%2e%5c)/i", $_QUERY_STRING) ||
                    preg_match("/(;|<|>|'|\"|\)|%0A|%0D|%22|%27|%3C|%3E|%00).*(\*|union|select|insert|cast|set|declare|drop|update|md5|benchmark).*/i", $_QUERY_STRING) ||
                    preg_match("/union([^a]*a)+ll([^s]*s)+elect/i", $_QUERY_STRING)
                )
                {
                    redirect('landing/error/ole');
                }
            }
    }

    public function secure_headers()
    {
        @header("Accept-Encoding: gzip, deflate");
        @header("X-UA-Compatible: IE=edge,chrome=1");
        @header("X-XSS-Protection: 1; mode=block");
        @header("X-Frame-Options: sameorigin");
        @header("X-Content-Type-Options: nosniff");
        @header("X-Permitted-Cross-Domain-Policies: master-only");
        @header("Referer-Policy: origin");
        @header("X-Download-Options: noopen");
        @header("Access-Control-Allow-Methods: GET, POST");
        @header("X-Powered-By: iNSTINCT");
        @header("Server: iNSTINCT");
    }

    public function processhtml($buffer)
    {
        if (ini_get('zlib.output_compression'))
        {
            ini_set("zlib.output_compression", 1);
            ini_set("zlib.output_compression_level", "9");
        }

        if ($this->isHTML($buffer)) {
            $pattern = "/<script[^>]*>(.*?)<\/script>/is";
            preg_match_all($pattern, $buffer, $matches, PREG_SET_ORDER, 0);
            foreach ($matches as $match) {
                $pattern = "/(<script[^>]*>)(" . preg_quote($match[1], '/') . ")(<\/script>)/is";
                $compress = $this->compressJS($match[1]);
                $buffer = preg_replace($pattern, '$1' . $compress . '$3', $buffer);
            }
            $pattern = "/<style[^>]*>(.*?)<\/style>/is";
            preg_match_all($pattern, $buffer, $matches, PREG_SET_ORDER, 0);
            foreach ($matches as $match) {
                $pattern = "/(<style[^>]*>)(" . preg_quote($match[1], '/') . ")(<\/style>)/is";
                $compress = $this->compressCSS($match[1]);
                $buffer = preg_replace($pattern, '$1' . $compress . '$3', $buffer);
            }
            $buffer = preg_replace(array('/<!--[^\[](.*)[^\]]-->/Uis', "/[[:blank:]]+/", '/\s+/'), array('', ' ', ' '), str_replace(array("\n", "\r", "\t"), '', $buffer));
        }
        return $buffer;
    }

    public function secureHTML($buffer)
    {
        $buffer = preg_replace("/<script(?!.*(src\\=))[^>]*>/", "<script type=\"text/javascript\">", $buffer);

        libxml_use_internal_errors(true);

        $doc = new DOMDocument();
        $doc->formatOutput = true;
        $doc->preserveWhiteSpace = false;
        $doc->loadHTML($buffer);

        $days_to_cache = 1 * (60 * 60 * 24);
        $ts = gmdate("D, d M Y H:i:s", time() + $days_to_cache) . " GMT";
        $tags = $doc->getElementsByTagName('head');

        foreach ($tags as $tag) {
            $item = $doc->createElement("meta");
            $item->setAttribute("http-equiv", "cache-control");
            $item->setAttribute("content", "max-age=$days_to_cache, must-revalidate");
            $tag->appendChild($item);

            $item = $doc->createElement("meta");
            $item->setAttribute("http-equiv", "expires");
            $item->setAttribute("content", $ts);
            $tag->appendChild($item);

            $item = $doc->createElement("meta");
            $item->setAttribute("http-equiv", "pragma");
            $item->setAttribute("content", "cache");
            $tag->appendChild($item);

            $item = $doc->createElement("script", "
			(function() {
			    var _z = console;
				Object.defineProperty( window, \"console\", {
					get : function(){
					    if( _z._commandLineAPI ){
						throw \"Hey if you are seeing this, Just know the noobiness in you is showing!\";
					          }
					    return _z; 
					},
					set : function(val){
					    _z = val;
					}
				});
			});");
            $item->setAttribute("type", "text/javascript");
            $tag->appendChild($item);
        }

        $tags = $doc->getElementsByTagName('input');
        foreach ($tags as $tag) {
            $type = array("text", "search", "password", "datetime", "date", "month", "week", "time", "datetime-local", "number", "range", "email", "color");
            if (in_array($tag->getAttribute('type'), $type)) {
                $tag->setAttribute("autocomplete", "off");
            }
        }

        $tags = $doc->getElementsByTagName('a');
        foreach ($tags as $tag) {
            $tag->setAttribute("rel", "noopener noreferrer");
        }

        $output = $doc->saveHTML();
        return $output;
    }

    public function compressCSS($buffer)
    {
        if (ini_get('zlib.output_compression')) {
            ini_set("zlib.output_compression", 1);
            ini_set("zlib.output_compression_level", "9");
        }
        return preg_replace(array('#\/\*[\s\S]*?\*\/#', '/\s+/'), array('', ' '), str_replace(array("\n", "\r", "\t"), '', $buffer));
    }

    public function compressJS($buffer)
    {
        if (ini_get('zlib.output_compression')) {
            ini_set("zlib.output_compression", 1);
            ini_set("zlib.output_compression_level", "9");
        }
        return str_replace(array("\n", "\r", "\t"), '', preg_replace(array('#\/\*[\s\S]*?\*\/|([^:]|^)\/\/.*$#m', '/\s+/'), array('', ' '), $buffer));
    }

    public function ishtml($string)
    {
        return preg_match('/<html.*>/', $string) ? true : false;
    }
}