<?php


namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\App;


class DemoController
{
    public function __construct()
    {
    }

    public function index(): Factory|View|Application
    {




        return view('landing');


    }
    public function about(): Factory|View|Application
    {

        return view('landing');


    }
    public function other(): Factory|View|Application
    {
        return view('landing');
    }
    public function dropDownOne(): Factory|View|Application
    {
        return view('landing');


    }
    public function dropDownTwo(): Factory|View|Application
    {
        return view('landing');


    }
    public function dropDownTree(): Factory|View|Application
    {
        return view('landing');


    }
    public function dropDownFour(): Factory|View|Application
    {
        return view('landing');


    }
    public function switchLang() : Factory|View|Application
    {
        App::setLocale($_POST['language']);
        header('location: /');
        redirect()->back();
        return view('landing');
    }
}
