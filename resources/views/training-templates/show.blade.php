@php
    use App\Models\Exercise;
@endphp
<x-layout>
    @include('partials._nav')
    <div class="container-fluid position-relative py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 bg-white p-6 rounded">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="fs-1">
                            Title: {{ $template->title }}
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <p class="fs-1">
                            Category: {{ $template->category }}
                        </p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @php
                        $workoutCount = $template->workouts()->count();
                        if ($workoutCount == 4 || $workoutCount == 5) {
                            $colIndex = 3;
                        } elseif ($workoutCount == 3 || $workoutCount == 6) {
                            $colIndex = 4;
                        } else {
                            $colIndex = 6;
                        }
                    @endphp
                    @foreach ($template->workouts as $workout)
                        <div class="col-lg-{{ $colIndex }}">
                            <p class="fs-3">
                                {{ $workout->title }}
                            </p>
                            @foreach ($workout->exercises as $exercise)
                                <div class="row border bg-primary text-white">
                                    <p class="mb-0">
                                        {{ $exercise->order }} {{ Exercise::find($exercise->exercise_id)->name }}
                                    </p>
                                </div>
                                <div class="row row-cols-4 border">
                                    <div class="col border">
                                        <p class="mb-0">
                                            Sets
                                        </p>
                                    </div>
                                    <div class="col border">
                                        <p class="mb-0">
                                            Reps
                                        </p>
                                    </div>
                                    <div class="mb-0 border">
                                        <p class="mb-0">
                                            Tempo
                                        </p>
                                    </div>
                                    <div class="col border">
                                        <p class="mb-0">
                                            Rest
                                        </p>
                                    </div>
                                    <div class="col border">
                                        {{ $exercise->set }}
                                    </div>
                                    <div class="col border">
                                        {{ $exercise->rep }}
                                    </div>
                                    <div class="col border">
                                        {{ $exercise->tempo }}
                                    </div>
                                    <div class="col border">
                                        {{ $exercise->tempo }}
                                    </div>
                                </div>
                                <div class="row border">
                                    <p class="mb-0">
                                        Technique
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="mb-0">
                                        {{ $exercise->technique }}
                                    </p>
                                </div>
                                <div class="row border">
                                    <p class="mb-0">
                                        Notes
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="mb-0">
                                        {{ $exercise->note }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="position-fixed top-50 start-0">
            <div class="d-grid">
                <a href="{{ action('TrainingTemplateController@edit', ['userId' => $template->user_id, 'template' => $template]) }}"
                    class="btn btn-warning">
                    Edit
                </a>
            </div>
            <form method="POST" action="/trainings/{{ $template->id }}" onsubmit="return confirm('Confirm delete')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>
        </div>
    </div>
</x-layout>
