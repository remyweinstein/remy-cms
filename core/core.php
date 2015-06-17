<?php

if(!Engine::getConfigIni()) { die("Remy Cms не установлена"); }

dB::init();
Engine::init();
Url::init();

$user = new User;

$contentPage = new Engine::$curModule;

if(Engine::$curTemplate == "none") {
	echo $contentPage->content;
} else {
	require_once (TEMPLATES.Engine::$curTemplate.'/template.php');
}




