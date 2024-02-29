<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gpu;
use App\Models\Cpu;
use App\Models\Game;
use App\Models\Computer;

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
        $employees = $this->getData('collections/employees');
        return view('pages.about', compact('data', 'employees'));
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
        $gpus = Gpu::all();
        $cpus = Cpu::all();
        $computers = Computer::query()->limit(4)->get();

        return view('pages.assembly', compact('data', 'gpus', 'cpus', 'computers'));
    }

    public function servers()
    {
        $data = $this->getData('servers');
        $games = Game::query()->limit(4)->get();
        
        return view('pages.servers', compact('data', 'games'));
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
