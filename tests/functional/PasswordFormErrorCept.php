<?php

$I = new FunctionalTester($scenario);
$I->wantTo('attempt to remind my password');

$I->haveRecord('users', [
    'name'       => 'Joe Doe',
    'email'      => 'joe@doe.com',
    'password'   => bcrypt('123'),
    'created_at' => new DateTime(),
    'updated_at' => new DateTime(),
    'is_confirm' => 0
]);

$I->amOnPage('/Password');
$I->fillField('email', 'joe@doe.com');
$I->click('button[type=submit]');
$I->see('Ten adres e-mail nie został zweryfikowany.');