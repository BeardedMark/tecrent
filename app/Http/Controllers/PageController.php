<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gpu;
use App\Models\Cpu;
use App\Models\Game;
use App\Models\Computer;
use App\Models\Requirement;
use App\Models\Post;

class PageController extends Controller
{
    public function main()
    {
        $title = env('APP_NAME');
        $description = 'Аренда игровых и офисных компьютеров';

        $data = $this->getData('main');
        $posts = Post::inRandomOrder()->take(3)->get();
        $games = Game::inRandomOrder()->take(4)->get();
        $computers = Computer::inRandomOrder()->take(4)->get();

        
        return view('pages.main', compact('data', 'posts', 'games', 'computers', 'title', 'description'));
    }

    public function about()
    {
        $data = $this->getData('about');
        $employees = $this->getData('collections/employees');
        $examples = $this->getData('collections/examples');
        $services = $this->getData('collections/services');

        $games = Game::all();
        $requirements = Requirement::all();
        $gpus = Gpu::all();
        $cpus = Cpu::all();
        $computers = Computer::all();
        $posts = Post::all();

        // $functions = Post::whereIn('id', [7, 8, 9])->get();
        // $examples = Post::whereIn('id', [1, 2, 3, 4, 5, 6])->get();

        return view('pages.about', compact('data', 'employees', 'games', 'requirements', 'gpus', 'cpus', 'computers', 'posts', 'examples', 'services'));
    }

    public function contacts()
    {
        $data = $this->getData('contacts');
        return view('pages.contacts', compact('data'));
    }

    public function work()
    {
        $data = $this->getData('work');
        $questions = $this->getData('collections/questions');
        $steps = $this->getData('collections/steps');
        $features = $this->getData('collections/features');
        $securitys = $this->getData('collections/securitys');
        // $steps = Post::whereIn('id', [10, 11, 12, 15, 13, 14])->get();

        return view('pages.work', compact('data', 'questions', 'steps', 'features', 'securitys'));
    }

    public function assembly()
    {
        $data = $this->getData('assembly');
        $gpus = Gpu::all();
        $cpus = Cpu::all();
        $computers = Computer::query()->orderBy('price', 'desc')->limit(4)->get();
        $games = Game::query()->orderBy('release', 'asc')->limit(4)->get();

        return view('pages.assembly', compact('data', 'gpus', 'cpus', 'computers', 'games'));
    }

    public function servers()
    {
        $data = $this->getData('servers');
        $games = Game::query()->where('is_server', true)->limit(4)->get();
        
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
