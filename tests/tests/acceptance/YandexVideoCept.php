<?php

class YandexVideoCept {


    public function checkTrailer(AcceptanceTester $I)
    {
        $I->wantTo('Find video and check it\'s trailer');
        $I->amOnPage('/');

        $allSessions = RemoteWebDriver::getAllSessions();
        $ses = $allSessions[0];
        $session_json = json_encode($ses);
        $decode_session_json = json_decode($session_json, false);
        $id = $decode_session_json->{'id'};
        $driver = RemoteWebDriver::createBySessionID($id);

        $I->seeElement('input');
        $I->fillField('input', 'ураган');
        $I->click('.websearch-button');
        $videosList = $driver->findElement(WebDriverBy::className('serp-controller__content'));
        $video = $videosList->findElements(WebDriverBy::cssSelector('div.thumb-image__preview.thumb-preview__target'));
        $driver->getMouse()->mouseMove($video[0]->getCoordinates());
        $I->assertTrue($video[0]->findElement(WebDriverBy::className('video.thumb-preview__video'))->isEnabled());

        #$host = 'http://localhost:4444/wd/hub';
        #$driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox(), 5000);
        #$I->wantTo('perform actions and see result');
        #$I->amOnPage('https://yandex.ru/video/');
        #$I->seeElement('input');
        #$I->fillField('input', 'ураган');
        ##$I->click('.websearch-button');
        #$I->moveMouseOver('');
        #$videosList = $driver->findElement(WebDriverBy::className('serp-controller__content'));
        #$video = $videosList->findElements(WebDriverBy::cssSelector('div.thumb-image__preview.thumb-preview__target'));
        #$driver->getMouse()->mouseMove($video[0]->getCoordinates());
        #assertTrue($video[0]->findElement(WebDriverBy::className('thumb-preview__video'))->isEnabled());

    }


    public function checkTrailer1(\AcceptanceTester $I)
    {
        $I->wantTo('perform actions and see result');
        $I->amOnPage('/');

        $allSessions = RemoteWebDriver::getAllSessions();
        $ses = $allSessions[0];
        $session_json = json_encode($ses);
        $decode_session_json = json_decode($session_json, false);
        $id = $decode_session_json->{'id'};
        $driver = RemoteWebDriver::createBySessionID($id);

        $I->seeElement('input');
        $I->fillField('input', 'ураган');
        $I->click('.websearch-button');
        $videosList = $driver->findElement(WebDriverBy::className('serp-controller__content'));
        $video = $videosList->findElements(WebDriverBy::cssSelector('div.thumb-image__preview.thumb-preview__target'));
        $driver->getMouse()->mouseMove($video[0]->getCoordinates());
        $I->assertTrue($video[0]->findElement(WebDriverBy::className('thumb-preview__video'))->isEnabled());

        #$host = 'http://localhost:4444/wd/hub';
        #$driver = RemoteWebDriver::create($host, DesiredCapabilities::firefox(), 5000);
        #$I->wantTo('perform actions and see result');
        #$I->amOnPage('https://yandex.ru/video/');
        #$I->seeElement('input');
        #$I->fillField('input', 'ураган');
        ##$I->click('.websearch-button');
        #$I->moveMouseOver('');
        #$videosList = $driver->findElement(WebDriverBy::className('serp-controller__content'));
        #$video = $videosList->findElements(WebDriverBy::cssSelector('div.thumb-image__preview.thumb-preview__target'));
        #$driver->getMouse()->mouseMove($video[0]->getCoordinates());
        #assertTrue($video[0]->findElement(WebDriverBy::className('thumb-preview__video'))->isEnabled());

    }


}



