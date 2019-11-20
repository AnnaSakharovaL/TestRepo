<?php
namespace Page\Acceptance;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

class VideoSearchingPage extends UtilFunctions
{
    // include url of current page
    public static $url = 'https://yandex.ru/video/';
    public static $searchFieldCss = 'input';
    public static $searchStartButtonCss = 'button.websearch-button';
    public static $foundVideosListCss = 'div.serp-controller__content';
    public static $videoCss = 'div.thumb-image__preview.thumb-preview__target';
    public static $trailerCss = 'video.thumb-preview__video';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$url.$param;
    }

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;
    protected $wd;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
        $allSessions = RemoteWebDriver::getAllSessions();
        $ses = $allSessions[0];
        $session_json = json_encode($ses);
        $decode_session_json = json_decode($session_json, false);
        $id = $decode_session_json->{'id'};
        $this->wd = RemoteWebDriver::createBySessionID($id);
    }

    private function wait($element) {
        $this->acceptanceTester->waitForElement($element);
    }

    public function goToVideoSearchingPage() {
        $this->acceptanceTester->amOnPage('/');
    }

    public function waitForSearchingField() {
        $this->wait(self::$searchFieldCss);
        $this->acceptanceTester->seeElement(self::$searchFieldCss);
    }

    public function searchVideo($videoName) {
        $this->fieldFilling($this->acceptanceTester, self::$searchFieldCss, $videoName);
        $this->buttonClick($this->acceptanceTester, self::$searchStartButtonCss);
    }

    public function waitForVideosList() {
        $this->wait(self::$foundVideosListCss);
    }

    public function checkVideoTrailer() {
        $searchingResult = $this->getElementFromPage($this->wd, self::$foundVideosListCss);
        $videosList = $this->getElementsCollectionFromOtherElement($searchingResult, self::$videoCss);
        $video = $videosList[0];
        $this->elementHover($this->wd, $video, self::$videoCss);
        $trailer = $video->findElement(WebDriverBy::cssSelector(self::$trailerCss));
        $this->checkElementIsVisible($trailer);
    }

}
