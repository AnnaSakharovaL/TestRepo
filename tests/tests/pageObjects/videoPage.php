<?php

class somethingPageObjects extends \AcceptanceTester
{
    public static $emailAdress = 'someSelector';

    public static $password = 'someSelector';

    public static $logInBtn = 'someSelector';

    // Sign in helper function to be called and used whenever er needed
    public function signin()
    {
        $this->fillField(somethingPageObjects::$emailAdress, '');
        $this->fillField(somethingPageObjects::$password, '');
        $this->click(somethingPageObjects::$logInBtn);
    }
}