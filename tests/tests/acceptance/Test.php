<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$U = new VideoSearchingPage($I);

$U->goToVideoSearchingPage();
$U->waitForSearchingField();
$U->searchVideo('ураган');
$U->waitForVideosList();
$U->checkVideoTrailer();



