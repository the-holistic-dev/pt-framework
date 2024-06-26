<x-layout>
    <h1>Index</h1>
    @if (sizeof($workouts) > 0)
        @foreach ($workouts as $workout)
            <h2>{{ $workout->title }}</h2>
        @endforeach
    @else
        <h1>No workout</h1>
    @endif
</x-layout>
