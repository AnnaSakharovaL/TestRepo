<?php

use Page\Acceptance\VideoSearchingPage;

$I = new AcceptanceTester($scenario);
$I->wantTo('Find video and check the trailer');

$U = new VideoSearchingPage($I);

$U->goToVideoSearchingPage();
$U->waitForSearchingField();
$U->searchVideo('ураган');
$U->waitForVideosList();
$U->checkVideoTrailer();
