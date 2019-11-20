<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{

    private $webDriver = null;
    private $webDriverModule = null;
    /**
     * Event hook before a test starts.
     *
     * @param \Codeception\TestCase $test
     *
     * @throws \Exception
     */

    function seeTrue( $a ) {
        $this->assertTrue( $a );
    }

    public function getWebDriver()
    {
        $webDriver = $this->getModule(‘WebDriver’);
        return $webDriver;
    }

    public function _before(\Codeception\TestCase $test)
    {
            $this->webDriverModule = $this->getModule('WebDriver');
            $this->webDriver = $this->webDriverModule->webDriver;
    }
    /**
     * Ожидание загрузки ajax.
     *
     * @param $timeout
     */
    public function waitAjaxLoad($timeout = 10)
    {
        $this->webDriverModule->waitForJS('return !!window.jQuery && window.jQuery.active == 0;', $timeout);
        $this->webDriverModule->wait(1);
        $this->dontSeeJsError();
    }
    /**
     * Ожидание загрузки страницы.
     *
     * @param $timeout
     */
    public function waitPageLoad($timeout = 10)
    {
        $this->webDriverModule->waitForJs('return document.readyState == "complete"', $timeout);
        $this->waitAjaxLoad($timeout);
        $this->dontSeeJsError();
    }
    /**
     * Переход на страницу.
     *
     * @param $link
     * @param $timeout
     */
    public function amOnPage($link, $timeout = 10)
    {
        $this->webDriverModule->amOnPage($link);
        $this->waitPageLoad($timeout);
    }
    /**
     * @param $identifier
     * @param $elementID
     * @param $excludeElements
     * @param $element
     */
    public function dontSeeVisualChanges($identifier, $elementID = null, $excludeElements = null, $element = false)
    {
        if ($element !== false) {
            $this->webDriverModule->moveMouseOver($element);
        }
        $this->getModule('VisualCeption')->dontSeeVisualChanges($identifier, $elementID, $excludeElements);
        $this->dontSeeJsError();
    }
    /**
     * Проверяем отсутствие ошибок в консоли.
     */
    public function dontSeeJsError()
    {
        $logs = $this->webDriver->manage()->getLog('browser');
        foreach ($logs as $log) {
            if ($log['level'] == 'SEVERE') {
                throw new ModuleException($this, 'Some error in JavaScript: ' . json_encode($log));
            }
        }
    }

}
