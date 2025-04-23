<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main()
    {
        $data = $this->getDataPage('main');
        return view('pages.main', compact('data'));
    }

    public function contacts()
    {
        $data = $this->getDataPage('contacts');
        return view('pages.contacts', compact('data'));
    }

    // Pages

    public function menu()
    {
        $data = $this->getDataPage('menu');
        return view('components.page', compact('data'));
    }

    public function about()
    {
        $data = $this->getDataPage('about');
        return view('components.page', compact('data'));
    }

    public function work()
    {
        $data = $this->getDataPage('work');
        return view('components.page', compact('data'));
    }

    public function business()
    {
        $data = $this->getDataPage('business');
        return view('components.page', compact('data'));
    }

    public function gamers()
    {
        $data = $this->getDataPage('gamers');
        return view('components.page', compact('data'));
    }

    public function policy()
    {
        $data = $this->getDataPage('policy');
        return view('components.page', compact('data'));
    }

    // private section

    private function getDataPage($jsonFileName)
    {
        $fileContent = storage_path('data/json/pages/' . $jsonFileName . '.json');
        $jsonContent = file_get_contents($fileContent);
        $data = json_decode($jsonContent, true);

        return $data;
    }

    private function getData($jsonFileName)
    {
        $fileContent = storage_path('data/json/content/' . $jsonFileName . '.json');
        $jsonContent = file_get_contents($fileContent);
        $data = json_decode($jsonContent, true);

        return $data;
    }
}
