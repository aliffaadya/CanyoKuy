<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tour->title }} | Your Guide</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9fafb; }
    </style>
</head>
<body>

<nav class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold text-indigo-600">Your Guide</div>
        <div class="flex gap-6">
            <a href="/" class="text-gray-600 hover:text-indigo-600">Home</a>
            <a href="#" class="text-gray-600 hover:text-indigo-600">Tours</a>
            <a href="#" class="text-gray-600 hover:text-indigo-600">About</a>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Kiri -->
        <div class="lg:col-span-2">
            <img src="{{ $tour->image_url }}" class="w-full h-96 object-cover rounded-2xl mb-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm">
                <div class="text-sm text-indigo-600 mb-2">{{ $tour->subtitle }}</div>
                <h1 class="text-3xl font-bold mb-4">{{ $tour->title }}</h1>
                <p class="text-gray-600 leading-relaxed mb-6">{{ $tour->description }}</p>
                <div class="grid grid-cols-2 gap-4 py-4 border-t border-b">
                    <div><span class="text-gray-500">Duration</span><br><strong>{{ $tour->duration }} days</strong></div>
                    <div><span class="text-gray-500">Region</span><br><strong>{{ $tour->region }}</strong></div>
                    <div><span class="text-gray-500">Max persons</span><br><strong>{{ $tour->max_persons }}</strong></div>
                    <div><span class="text-gray-500">Category</span><br><strong class="capitalize">{{ $tour->category }}</strong></div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm mt-6">
                <h2 class="text-xl font-bold mb-4">Tour Highlights</h2>
                <ul class="space-y-2">
                    <li>✓ Expert local guides</li>
                    <li>✓ Accommodation included</li>
                    <li>✓ Daily meals</li>
                    <li>✓ All transportation</li>
                </ul>
            </div>
        </div>

        <!-- Kanan -->
        <div>
            <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-4">
                <div class="mb-4">
                    <span class="text-3xl font-bold">{{ number_format($tour->price) }} ₽</span>
                    <span class="text-gray-500">/ person</span>
                </div>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between"><span class="text-gray-600">Duration</span><span>{{ $tour->duration }} days</span></div>
                    <div class="flex justify-between"><span class="text-gray-600">Group size</span><span>Up to {{ $tour->max_persons }}</span></div>
                    <hr>
                    <div class="flex justify-between font-bold"><span>Total</span><span>{{ number_format($tour->price) }} ₽</span></div>
                </div>
                <button class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700">Book Now</button>
                <button class="w-full border border-gray-300 py-3 rounded-xl font-semibold mt-3 hover:bg-gray-50">Ask a Question</button>
            </div>
        </div>
    </div>

    <!-- SEE ALSO -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-2">SEE ALSO</h2>
        <div class="text-sm text-gray-500 mb-4"># Related tours</div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($relatedTours as $related)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md">
                <img src="{{ $related->image_url }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <div class="text-xs text-indigo-600">{{ $related->subtitle }}</div>
                    <h3 class="font-bold text-lg">{{ $related->title }}</h3>
                    <p class="text-sm text-gray-500 my-2">{{ \Illuminate\Support\Str::limit($related->description, 80) }}</p>
                    <div class="flex justify-between items-center mt-2">
                        <span class="font-bold">{{ number_format($related->price) }} ₽</span>
                        <a href="/tour/{{ $related->id }}" class="text-indigo-600 text-sm font-medium">See details →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-12 pt-6 border-t text-center text-gray-400 text-sm">
        Our Partners | © 2026 Your Guide
    </div>
</div>

</body>
</html>