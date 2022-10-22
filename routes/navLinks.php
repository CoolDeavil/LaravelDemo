<?php
/**@var NavBuilder $nav  */

use App\Services\Navigation\NavBuilder;

$user_avatar = "http://$_SERVER[HTTP_HOST]/images/default_avatar.png";
$userID  = 1;
$loggedUser  = false;


$nav->link('OPTION1', 'DemoController.index', 'fa-home');
$nav->link('OPTION2', 'DemoController.about', 'fa-cogs');
$nav->link('OPTION3', 'DemoController.other', 'fa-star');

$nav->drop('DROPDOWN')
    ->entry('DROPDOWN_ONE', 'DemoController.dropDownOne','fa-desktop')
    ->entry('DROPDOWN_TWO', 'DemoController.dropDownTwo','fa-road')
    ->entry('DROPDOWN_TREE', 'DemoController.dropDownTree','fa-star')
    ->separator()
    ->entry('DROPDOWN_FOUR', 'DemoController.dropDownFour','fa-book');

$nav->admin()
    ->entry('REGISTER', 'DemoController.dropDownFour', 'fa-user-plus', [],'GUEST')
    ->entry('LOG_IN', 'DemoController.dropDownFour', 'fa-sign-in-alt', [],"GUEST")
    ->avatar($user_avatar, 'DemoController.dropDownFour', ['id'=>$userID],"USER")
    ->entry('LOG_OUT', 'DemoController.dropDownFour', 'fa-sign-out-alt', [],"USER");
