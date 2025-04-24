<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    public function index(Request $request)
    {
        $query = Fruit::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        if ($request->filled('family')) {
            $query->where('family', 'like', "%{$request->family}%");
        }

        $fruits = $query->paginate(10);

        return view('dashboard', compact('fruits'));
    }

    public function favorite(Request $request, $fruitId)
    {
        $count = Favorite::count();
        if ($count >= 10) {
            return redirect()->route('dashboard')->withErrors(['message' => 'Maximum of 10 favorites reached.']);
        }

        $exists = Favorite::where('fruit_id', $fruitId)->exists();
        if ($exists) {
            return redirect()->route('dashboard')->withErrors(['message' => 'Fruit already favorited.']);
        }

        Favorite::create(['fruit_id' => $fruitId]);

        return redirect()->route('dashboard')->with('message', 'Fruit added to favorites.');
    }

    public function favorites()
    {
        $favorites = Favorite::with('fruit')->get();

        $nutritionSum = [
            'carbohydrates' => 0,
            'protein' => 0,
            'fat' => 0,
            'calories' => 0,
            'sugar' => 0,
        ];

        foreach ($favorites as $favorite) {
            $n = json_decode($favorite->fruit->nutritions, true);
            foreach ($nutritionSum as $key => $val) {
                $nutritionSum[$key] += $n[$key] ?? 0;
            }
        }

        return view('favorites', compact('favorites', 'nutritionSum'));
    }
}
