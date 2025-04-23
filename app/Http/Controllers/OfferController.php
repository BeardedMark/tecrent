<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::inRandomOrder()->paginate(30);
        $rent = Offer::getByType('Аренда')->inRandomOrder()->paginate(6);
        $trade = Offer::getByType('Товары')->inRandomOrder()->paginate(6);
        $service = Offer::getByType('Услуги')->inRandomOrder()->paginate(6);

        $favorites = Offer::getFavorited()->inRandomOrder()->paginate(6);
        $sales = Offer::getSale()->inRandomOrder()->paginate(6);
        $main = Offer::getLatestMain();

        return view('offers.index', compact('offers', 'rent', 'trade', 'service', 'favorites', 'sales', 'main'));
    }

    public function search(Request $request)
    {
        $types = Offer::getUniqueTypes();
        $groups = Offer::getUniqueGroups();
        $tags = Offer::getUniqueTags();

        // $offers = isset($request) ? Offer::search($request) : Offer::latest()->get();
        $offers = Offer::search($request);
        $title = collect($request->all())
        ->map(fn($value, $key) => is_array($value) ? implode(',', $value) : $value)
        ->implode(', ');

        return view('offers.search', compact('offers', 'title', 'types', 'groups', 'tags'));
    }

    public function create()
    {
        return view('offers.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data = $this->handleUploads($request, $data);

        $offer = Offer::create($data);

        return redirect()->route('offers.show', compact('offer'))->with('success', "Предложение №$offer->id создано");
    }

    public function show($id)
    {
        $query = Offer::query();

        if (auth()->user() && auth()->user()->is_admin) {
            $query->withTrashed();
        }

        $offer = $query->findOrFail($id);
        return view('offers.show', compact('offer'));
    }

    public function edit(Offer $offer)
    {
        return view('offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        $data = $this->validateData($request);
        $data = $this->handleUploads($request, $data, $offer);

        $offer->update($data);

        return redirect()->route('offers.show', compact('offer'))->with('success', "Предложение №$offer->id обновлено");
    }

    public function destroy($id)
    {
        $offer = Offer::withTrashed()->find($id);

        if (!$offer) {
            return redirect()->back()->with('error', "Предложение №$id не найдено");
        }

        if ($offer->trashed()) {
            $offer->restore();
            return redirect()->route('offers.show', compact('offer'))->with('success', "Предложение №$id восстановлено");
        } else {
            $offer->delete();
            return redirect()->route('offers.show', compact('offer'))->with('success', "Предложение №$id удалено");
        }
    }

    public function toggleMain($id)
    {
        $offer = Offer::findOrFail($id);
        if ($offer) {
            Offer::query()->update(['main_at' => null]);
        }
        $offer->update(['main_at' => $offer->main_at ? null : now()]);
        $message = $offer->main_at ? "отмечено как главное" : "снято главенство";
        return redirect()->back()->with('success', "Предложение №$id $message");
    }

    public function toggleFavorite($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->update(['favorited_at' => $offer->favorited_at ? null : now()]);
        $message = $offer->favorited_at ? "добавлено в избранное" : "удалено из избранного";
        return redirect()->back()->with('success', "Предложение №$id $message");
    }

    public function togglePublished($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->update(['published_at' => $offer->published_at ? null : now()]);
        $message = $offer->published_at ? "опубликовано" : "публикация отменена";
        return redirect()->back()->with('success', "Предложение №$id $message");
    }

    public function toggleArchived($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->update(['archived_at' => $offer->archived_at ? null : now()]);
        $message = $offer->archived_at ? "архивировано" : "архивация отменена";
        return redirect()->back()->with('success', "Предложение №$id $message");
    }


    private function validateData(Request $request)
    {
        return $request->validate([
            'type' => 'nullable|string|max:255',
            'group' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'comment' => 'nullable|string',
            'tags' => 'nullable|string',

            'template' => 'nullable|string|max:255',
            'rating' => 'nullable|integer',
            'data' => 'nullable|json',

            'price' => 'nullable|numeric|min:0',
            'sale' => 'nullable|numeric',
            'code' => 'nullable|string|max:50|unique:offers,code,' . ($request->offer->id ?? 'NULL'),
            'unit' => 'nullable|string|max:50',
            'stock' => 'nullable|integer',
            'min' => 'nullable|integer',
            'step' => 'nullable|integer',
            'max' => 'nullable|integer',

            'video' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'wallpaper' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_favicon' => 'nullable|string|max:255',

            'published_at' => 'nullable|date',
            'archived_at' => 'nullable|date',
            'main_at' => 'nullable|date',
            'favorited_at' => 'nullable|date',
        ]);
    }

    private function handleUploads(Request $request, array $data, Offer $offer = null)
    {
        if ($request->hasFile('image')) {
            if ($offer && $offer->image) Storage::delete('public/img/offers/' . $offer->image);
            $data['image'] = $request->file('image')->store('img/offers', 'public');
        }

        if ($request->hasFile('wallpaper')) {
            if ($offer && $offer->wallpaper) Storage::delete('public/img/offers/' . $offer->wallpaper);
            $data['wallpaper'] = $request->file('wallpaper')->store('img/offers', 'public');
        }

        return $data;
    }
}
