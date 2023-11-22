<?php

namespace App\Tests\Controller\Contact;

use App\Factory\ContactFactory;
use App\Tests\Support\ControllerTester;

class ShowCest
{
    public function verificationDesInfosDunContact(ControllerTester $I): void
    {
        $contact = ContactFactory::createOne(['email' => 'Aaaaaaaaaaaaaaa.Joe@gmail.com',
            'firstname' => 'Joe',
            'lastname' => 'Aaaaaaaaaaaaaaa']);
        $I->amOnPage("/contact/{$contact->getId()}");
        $I->seeResponseCodeIsSuccessful();
        $I->see('Données de Aaaaaaaaaaaaaaa, Joe', 'h1');
        $I->seeNumberOfElements('dl', 1);
        $I->seeNumberOfElements('dt', 5);
        $I->seeNumberOfElements('dd', 5);
        $I->see('
Nom :
    Aaaaaaaaaaaaaaa
Prenom :
    Joe
E-Mail :
    Aaaaaaaaaaaaaaa.Joe@gmail.com ', 'dl');
        $I->amOnPage('/contact/-1');
        $I->canSeePageNotFound();
    }
}
