<?php 
if(Engine::$curUrlName !="index") {
	echo '<div>
		'.Engine::BreadCrumbs(Engine::$curUrlName, $contentPage->title).'
		</div>
		';
	/*
	echo '<header>
		<h2>'.$contentPage->title.'</h2>
		</header>';
	*/
}
//echo '<div '.Engine::$contenteditable.'>';
echo $contentPage->content;
//echo '</div>';