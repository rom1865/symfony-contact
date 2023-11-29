<?php

namespace App\Tests\Controller\Contact;

use App\Factory\ContactFactory;
use App\Repository\CategoryRepository;
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

    public function controleDuTriDesContacts(ControllerTester $I, CategoryRepository $categoryRepository): void
    {
        $serviceCategory = $categoryRepository->find(4);

        ContactFactory::createSequence(
            [
                ['lastname' => 'abram', 'firstname' => 'lincolm', 'category' => $serviceCategory],
                ['lastname' => 'boto', 'firstname' => 'romain', 'category' => $serviceCategory],
                ['lastname' => 'colin', 'firstname' => 'nathan', 'category' => $serviceCategory],
                ['lastname' => 'dandan', 'firstname' => 'quentin', 'category' => $serviceCategory],
            ]
        );
        $I->amOnPage('/contact');
        $LiLinks = $I->grabMultiple('li.contacts');
        $I->assertEquals('4', count($LiLinks));
        // Ajoutez votre assertion pour vérifier la présence des noms avec la catégorie
        $expectedResults = [
            'abram, lincolm (service)',
            'boto, romain (service)',
            'colin, nathan (service)',
            'dandan, quentin (service)',
        ];
        $I->assertEquals($LiLinks, $expectedResults);
    }

    public function controleDeLaMethodeSearchLastname(ControllerTester $I, CategoryRepository $categoryRepository): void
    {
        $serviceCategory = $categoryRepository->find(4);

        ContactFactory::createSequence(
            [
                ['lastname' => 'testSearchLastnameFirst', 'firstname' => 'lincolm', 'category' => $serviceCategory],
                ['lastname' => 'testSearchLastnameSecond', 'firstname' => 'romain', 'category' => $serviceCategory],
                ['lastname' => 'testSearchLastnameThird', 'firstname' => 'nathan', 'category' => $serviceCategory],
                ['lastname' => 'testSearchLastnameFour', 'firstname' => 'quentin', 'category' => $serviceCategory],
            ]
        );
        $I->amOnPage('/contact?search=testSearchLastname');
        $LiLinks = $I->grabMultiple('li.contacts');
        $I->assertEquals('4', count($LiLinks));
        // Ajoutez votre assertion pour vérifier la présence des noms avec la catégorie
        $expectedResults = [
            'testSearchLastnameFirst, lincolm (service)',
            'testSearchLastnameFour, quentin (service)',
            'testSearchLastnameSecond, romain (service)',
            'testSearchLastnameThird, nathan (service)',
        ];
        $I->assertEquals($LiLinks, $expectedResults);
    }

    public function controleDeLaMethodeSearchFirstname(ControllerTester $I, CategoryRepository $categoryRepository): void
    {
        $serviceCategory = $categoryRepository->find(4);

        ContactFactory::createSequence(
            [
                ['lastname' => 'lahousse', 'firstname' => 'testSearchFirstnameFirst', 'category' => $serviceCategory],
                ['lastname' => 'crevet', 'firstname' => 'testSearchFirstnameSecond', 'category' => $serviceCategory],
                ['lastname' => 'chevrier', 'firstname' => 'testSearchFirstnameThird', 'category' => $serviceCategory],
                ['lastname' => 'licoml', 'firstname' => 'testSearchFirstnameFour', 'category' => $serviceCategory],
            ]
        );
        $I->amOnPage('/contact?search=testSearch');
        $LiLinks = $I->grabMultiple('li.contacts');
        $I->assertEquals('4', count($LiLinks));
        // Ajoutez votre assertion pour vérifier la présence des noms avec la catégorie
        $expectedResults = [
            'chevrier, testSearchFirstnameThird (service)',
            'crevet, testSearchFirstnameSecond (service)',
            'lahousse, testSearchFirstnameFirst (service)',
            'licoml, testSearchFirstnameFour (service)',
        ];
        $I->assertEquals($LiLinks, $expectedResults);
    }
}
