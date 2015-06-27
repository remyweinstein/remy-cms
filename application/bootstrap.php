<?php
if(!Engine::getConfigIni()) { die("Remy Cms не установлена"); }

dB::init();
Engine::init();
Url::init();
$user = new User;

Engine::run();