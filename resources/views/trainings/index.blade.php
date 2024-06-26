<x-layout>
    @include('partials._nav')
    <h1>Index</h1>
    @unless (sizeof($plans) == 0)
        @foreach ($plans as $plan)
            <a href="/training/{{ $plan->id }}">{{ $plan->title }}</a>
        @endforeach
    @endunless
</x-layout>
