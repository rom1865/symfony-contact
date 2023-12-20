<?php

namespace App\Tests\Controller\Contact;

use App\Entity\User;
use App\Factory\ContactFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class UpdateCest
{
    public function form(ControllerTester $I): void
    {
        ContactFactory::createOne([
            'firstname' => 'Homer',
            'lastname' => 'Simpson',
        ]);

        $I->amOnPage('/contact/1/update');

        $I->seeInTitle('Édition de Simpson, Homer');
        $I->see('Édition de Simpson, Homer', 'h1');

        $cretionCmpt = UserFactory::createOne([
            'roles' => ['ROLE_ADMIN'],
            'firstname' => 'himiko',
            'lastname' => 'toga',
            'email' => 'himiko@example.com',
            'password' => 'test',
        ]);
        $admin = $cretionCmpt->object();
        $I->amLoggedInAs($admin);
    }
}
