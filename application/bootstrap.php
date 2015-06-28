<?php
if(!Engine::getConfigIni()) { die("Remy Cms не установлена"); }

dB::init();
Engine::init();
Url::init();
Engine::run();