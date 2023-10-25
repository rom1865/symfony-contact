<?php

namespace App\Tests\Controller\Contact;

use App\Tests\Support\ControllerTester;

class ShowCest
{
    public function verificationDesInfosDunContact(ControllerTester $I): void
    {
        $I->amOnPage('/contact/12');
        $I->seeResponseCodeIsSuccessful();
        $I->see('Données de Delmas, Honoré', 'h1');
        $I->seeNumberOfElements('dl', 1);
        $I->seeNumberOfElements('dt', 3);
        $I->seeNumberOfElements('dd', 3);
        $I->see('
Nom :
    Delmas
Prenom :
    Honoré
E-Mail :
    honore.delmas@meyer.fr ', 'dl');
        $I->amOnPage('/contact/-1');
        $I->canSeePageNotFound();
    }
}
