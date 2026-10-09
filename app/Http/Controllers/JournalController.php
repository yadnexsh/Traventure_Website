<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalController extends Controller
{
    private $articles = [
        'the-ultimate-winter-trekking-packing-list' => [
            'title' => 'The Ultimate Winter Trekking Packing List',
            'slug' => 'the-ultimate-winter-trekking-packing-list',
            'category' => 'Preparation',
            'excerpt' => 'Layering is an art in the Himalayas. Discover exactly what you need to stay warm without overpacking your rucksack on your next winter expedition.',
            'body' => '<p>Winter trekking requires careful preparation. The key to staying warm in the mountains is layering. You need a moisture-wicking base layer, an insulating middle layer like fleece, and a waterproof/windproof outer shell.</p>
            <p>Don\'t forget essential accessories: a good quality beanie, polarized sunglasses to prevent snow blindness, and waterproof gloves. Your trekking boots should be broken-in, waterproof, and paired with merino wool socks to prevent blisters and keep your feet warm.</p>
            <p>Lastly, always carry a thermos for hot water and high-energy snacks like nuts and chocolates to keep your body fueled.</p>',
            'image' => 'media/header/header (1).jpg',
            'author' => 'Traventure Team',
            'date' => 'Oct 12, 2026'
        ],
        'understanding-acute-mountain-sickness' => [
            'title' => 'Understanding Acute Mountain Sickness (AMS)',
            'slug' => 'understanding-acute-mountain-sickness',
            'category' => 'Safety & Health',
            'excerpt' => 'Altitude affects everyone differently, regardless of fitness level. Learn the early signs of AMS, acclimatization rules, and when it\'s time to descend.',
            'body' => '<p>Acute Mountain Sickness (AMS) can happen to anyone above 8,000 feet, regardless of their physical fitness. It\'s caused by reduced air pressure and lower oxygen levels at high altitudes.</p>
            <p>Common symptoms include headaches, nausea, dizziness, and shortness of breath. The best way to prevent AMS is to acclimatize properly—climb high, sleep low, and ascend no more than 1,000 feet per day once above 10,000 feet.</p>
            <p>Hydration is crucial. Drink plenty of water and avoid alcohol and sleeping pills. If symptoms persist or worsen, the only cure is descending to a lower altitude immediately.</p>',
            'image' => 'media/header/header (2).jpg',
            'author' => 'Traventure Medical Team',
            'date' => 'Sep 28, 2026'
        ],
        'why-the-sahyadris-come-alive-in-the-monsoon' => [
            'title' => 'Why the Sahyadris Come Alive in the Monsoon',
            'slug' => 'why-the-sahyadris-come-alive-in-the-monsoon',
            'category' => 'Destinations',
            'excerpt' => 'From June to September, the rugged Western Ghats transform into a vibrant green paradise filled with hidden waterfalls, mist-covered forts, and unique biodiversity.',
            'body' => '<p>The Sahyadris (Western Ghats) undergo a miraculous transformation during the monsoon. Dry, brown landscapes suddenly turn lush green, and seasonal waterfalls cascade down rugged cliffs.</p>
            <p>Trekking here during the rains is an ethereal experience. You\'ll encounter mist-covered historical forts, deep valleys, and rare flora and fauna that only appear during this season. Some of the most popular treks include Harishchandragad, Rajmachi, and the challenging Sandhan Valley.</p>
            <p>Make sure to wear shoes with excellent grip, carry waterproof gear, and be cautious of slippery paths. The monsoon in the Sahyadris is an adventure you won\'t forget.</p>',
            'image' => 'media/header/header (3).jpg',
            'author' => 'Surendra J',
            'date' => 'Jul 15, 2026'
        ]
    ];

    public function index()
    {
        $articles = $this->articles;
        return view('journal.index', compact('articles'));
    }

    public function show($slug)
    {
        if (!array_key_exists($slug, $this->articles)) {
            abort(404);
        }
        
        $article = $this->articles[$slug];
        return view('journal.show', compact('article'));
    }
}
