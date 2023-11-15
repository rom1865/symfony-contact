<?php

namespace App\Tests\Controller\Contact;

use App\Factory\ContactFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function creationDe5Contacts(ControllerTester $I): void
    {
        ContactFactory::createMany(5);
    }

    public function testSurLaListeDesContacts(ControllerTester $I): void
    {
        $contact = ContactFactory::createOne(['email' => 'Aaaaaaaaaaaaaaa.Joe@gmail.com',
                                   'firstname' => 'Joe',
                                   'lastname' => 'Aaaaaaaaaaaaaaa']);
        ContactFactory::createMany(5);
        $I->amOnPage('/contact');
        $I->click('Aaaaaaaaaaaaaaa, Joe');
        $I->seeResponseCodeIsSuccessful();
        $I->seeCurrentRouteIs('app_contact_show', ['id' => $contact->getId()]);
    }

    public function controleDuTriDesContacts(ControllerTester $I): void
    {
        ContactFactory::createSequence(
            [
                ['lastname' => 'abram', 'firstname' => 'lincolm'],
                ['lastname' => 'boto', 'firstname' => 'romain'],
                ['lastname' => 'colin', 'firstname' => 'nathan'],
                ['lastname' => 'dandan', 'firstname' => 'quentin'],
            ]
        );
        $I->amOnPage('/contact');
        $LiLinks = $I->grabMultiple('li.contacts'); // Ajouter . au selecteur pour selectionner le nom de la class
        $I->assertEquals('4', count($LiLinks));
        $I->assertEquals($LiLinks, ['abram, lincolm', 'boto, romain', 'colin, nathan', 'dandan, quentin']);
    }

    public function controleDeLaMethodeSearchLastname(ControllerTester $I): void
    {
        ContactFactory::createSequence(
            [
                ['lastname' => 'testSearchLastnameFirst', 'firstname' => 'lincolm'],
                ['lastname' => 'testSearchLastnameSecond', 'firstname' => 'romain'],
                ['lastname' => 'testSearchLastnameThird', 'firstname' => 'nathan'],
                ['lastname' => 'testSearchLastnameFour', 'firstname' => 'quentin'],
            ]
        );
        $I->amOnPage('/contact?search=testSearchLastname');
        $LiLinks = $I->grabMultiple('li.contacts');
        $I->assertEquals('4', count($LiLinks));
        $I->assertEquals($LiLinks, ['testSearchLastnameFirst, lincolm',
                                    'testSearchLastnameFour, quentin',
                                    'testSearchLastnameSecond, romain',
                                    'testSearchLastnameThird, nathan']);
    }

    public function controleDeLaMethodeSearchFirstname(ControllerTester $I): void
    {
        ContactFactory::createSequence(
            [
                ['lastname' => 'lahousse', 'firstname' => 'testSearchFirstnameFirst'],
                ['lastname' => 'crevet', 'firstname' => 'testSearchFirstnameSecond'],
                ['lastname' => 'chevrier', 'firstname' => 'testSearchFirstnameThird'],
                ['lastname' => 'licoml', 'firstname' => 'testSearchFirstnameFour'],
            ]
        );
        $I->amOnPage('/contact?search=testSearch');
        $LiLinks = $I->grabMultiple('li.contacts');
        $I->assertEquals('4', count($LiLinks));
        $I->assertEquals($LiLinks, ['chevrier, testSearchFirstnameThird',
                                    'crevet, testSearchFirstnameSecond',
                                    'lahousse, testSearchFirstnameFirst',
                                    'licoml, testSearchFirstnameFour']);
    }
}
