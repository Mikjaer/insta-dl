#!/usr/bin/php
<?php

if (count($argv) != 2)
	die("Usage:\n".$argv[0]." <path-to-instagram-post>\n");
$url = $argv[1];

if (($html= @file_get_contents($url)) === FALSE)
	die("Error: Could not fetch: $url\n");

if (!preg_match_all("/\"(https:\/\/scontent.*?)\"/", $html, $matches))
	die("Error: Returned HTML does not seem to be an instagram post\n");

$url = $matches[1][0];	// First match is the picture in 1080p

$filename = substr(basename($url), 0, strpos(basename($url),"?"));
print "Filename: $filename\n";

$img = file_get_contents($url);
print "Size: ".strlen($img)." bytes\n";

file_put_contents($filename, $img);
