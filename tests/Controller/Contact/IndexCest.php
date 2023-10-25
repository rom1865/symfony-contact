<?php

namespace App\Tests\Controller\Contact;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function numberOfElementInPageIs195(ControllerTester $I): void
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
        $I->seeNumberOfElements('li', 195);
        $I->seeNumberOfElements('a', 195);
    }

    public function premierLienDeLaListeRouteCorrect(ControllerTester $I): void
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->click('Andre, Sébastien');
        $I->seeCurrentRouteIs('app_contact_show');
    }
}
