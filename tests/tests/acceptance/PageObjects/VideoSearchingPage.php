<?php


use phpDocumentor\Reflection\Types\String_;

class VideoSearchingPage extends Utils
{
    protected $I;
    protected $wd;

    public function __construct(AcceptanceTester $I)
    {
        $this->I = $I;
        $allSessions = RemoteWebDriver::getAllSessions();
        $ses = $allSessions[0];
        $session_json = json_encode($ses);
        $decode_session_json = json_decode($session_json, false);
        $id = $decode_session_json->{'id'};
        $this->wd = RemoteWebDriver::createBySessionID($id);
    }


    public static $url = 'https://yandex.ru/video/';
    public static $searchFieldCss = 'input';
    public static $searchStartButtonCss = 'button.websearch-button';
    public static $foundVideosListCss = 'div.serp-controller__content';
    public static $videoCss = 'div.thumb-image__preview.thumb-preview__target';
    public static $trailerCss = 'video.thumb-preview__video';

    private function wait($element) {
        $this->I->waitForElement($element);
    }

    public function goToVideoSearchingPage() {
        $this->I->amOnPage(self::$url);
    }

    public function waitForSearchingField() {
        $this->wait(self::$searchFieldCss);
        $this->I->seeElement(self::$searchFieldCss);
    }

    public function searchVideo($videoName) {
        $this->fieldFilling($this->I, self::$searchFieldCss, $videoName);
        $this->buttonClick($this->I, self::$searchStartButtonCss);
    }

    public function waitForVideosList() {
        $this->wait(self::$foundVideosListCss);
    }

    public function checkVideoTrailer() {
        $searchingResult = $this->getElementFromPage($this->wd, self::$foundVideosListCss);
        $videosList = $this->getElementsCollectionFromOtherElement($searchingResult, self::$videoCss);
        $video = $videosList[0];
        $this->elementHover($this->wd, $video);
        $trailer = $video->findElement(WebDriverBy::cssSelector(self::$trailerCss));
        $this->checkElementIsVisible($trailer);
    }
}