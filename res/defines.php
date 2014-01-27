<?php

	// Must be set first, otherwise you're going to have a bad time
	define('ROOTPATH',			dirname(__DIR__));
	
	// Used in the site
	define('ANTISPAMANSWERS', 	ROOTPATH.'/res/antispam/answers.txt');		// When used by Res files
	define('ANTISPAMQUESTIONS', ROOTPATH.'/res/antispam/questions.txt');	// When used by Res files
	define('DATEFORMAT',		'j M Y H:i');								// Used in News, Comments and Guestbook
	define('FILECOMMENTS',		ROOTPATH.'/news/comments.txt');				// File that contains comments for newsposts
	define('FILEGUESTBOOK',		ROOTPATH.'/content/guestbook/posts.txt');	// All guestbook posts
	define('FILELYRICS',		ROOTPATH.'/res/lyrics.txt');				// Lyric quotes that are displayed below main logo
	define('FILENEWS',			ROOTPATH.'/news/news.txt');					// File that contains news posts
	define('HOME',				ROOTPATH.'/index.php');						// The name of the main page
	define('PAGE',				'page');									// Name for GET parameter that selects the page to display
	define('RATINGPATH',		ROOTPATH.'/contents/ratings/');				// Album fan rating data files
	define('STYLESHEET',		'res/vortech2013.css');
			
?>