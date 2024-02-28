<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main()
    {
        $data = $this->getData('main');
        return view('pages.main', compact('data'));
    }

    public function about()
    {
        $data = $this->getData('about');
        return view('pages.about', compact('data'));
    }

    public function contacts()
    {
        $data = $this->getData('contacts');
        return view('pages.contacts', compact('data'));
    }

    public function work()
    {
        $data = $this->getData('work');
        return view('pages.work', compact('data'));
    }

    public function assembly()
    {
        $data = $this->getData('assembly');
        return view('pages.assembly', compact('data'));
    }

    public function servers()
    {
        $data = $this->getData('servers');
        return view('pages.servers', compact('data'));
    }

    public function menu()
    {
        $data = $this->getData('menu');
        return view('pages.menu', compact('data'));
    }

    // private section

    private function getData($jsonFileName)
    {
        $fileContent = storage_path('content/' . $jsonFileName . '.json');
        $jsonContent = file_get_contents($fileContent);
        $data = json_decode($jsonContent);

        return $data;
    }
}
