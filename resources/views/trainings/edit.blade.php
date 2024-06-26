@php
    use App\Models\Exercise;
@endphp
<x-layout>
    @include('partials._nav')
    <div class="bg-black bg-pattern-2 py-10">
        <div class="container bg-white p-4 rounded">
            <a href="/user/{{ $userId }}" class="btn btn-info">
                Back to client page
            </a>
            <h1>{{ $heading }}</h1>
            <form method="POST" action="/trainings/{{ $trainingPlan->id }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">
                            Title
                        </label>
                        <input type="text" name="title" class="form-control" value="{{ $trainingPlan->title }}">
                        @error('title')
                            <p>
                                ya focking dofus
                            </p>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label class="form-label">
                            Goal
                        </label>
                        <input type="text" name="goal" class="form-control" value="{{ $trainingPlan->goal }}">
                        @error('goal')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label class="form-label">
                            Phase
                        </label>
                        <select class="form-select" name="phase">
                            <option {{ $trainingPlan->phase == 'Accumulation' ? 'selected' : '' }}>
                                Accumulation
                            </option>
                            <option {{ $trainingPlan->phase == 'Intensification' ? 'selected' : '' }}>
                                Intensification
                            </option>
                        </select>
                    </div>
                </div>
                <ul class="nav nav-tabs justify-content-center my-3" role="tablist">
                    @for ($i = 0; $i < 5; $i++)
                        <?php $dayIndex = $i + 1; ?>
                        <?php $nextDayIndex = $i + 2; ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $i == 0 ? 'active' : '' }}"
                                id="day{{ $dayIndex }}{{ $nextDayIndex }}-tab" data-bs-toggle="tab"
                                data-bs-target="#day{{ $dayIndex }}{{ $nextDayIndex }}-tab-pane" type="button"
                                role="tab" aria-controls="day{{ $dayIndex }}{{ $nextDayIndex }}-tab-pane"
                                aria-selected="{{ $i == 0 ? 'true' : 'false' }}">
                                Day {{ $dayIndex }}-{{ $nextDayIndex }}
                            </button>
                        </li>
                        <?php ++$i; ?>
                    @endfor
                </ul>
                <div class="tab-content">
                    @for ($i = 0; $i < 5; $i++)
                        <?php $dayIndex = $i + 1; ?>
                        <?php $nextDayIndex = $i + 2; ?>
                        <div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}"
                            id="day{{ $dayIndex }}{{ $nextDayIndex }}-tab-pane" role="tabpanel"
                            aria-labelledby="day{{ $i + 1 }}-tab" tabindex="0">
                            <div class="row">
                                <div class="col-6">
                                    @if (isset($trainingPlan->workouts[$i]))
                                        @php
                                            $workout = $trainingPlan->workouts[$i];
                                        @endphp
                                        @include('partials._filled-workout')
                                    @else
                                        @include('partials._empty-workout')
                                    @endif
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <button type="button" class="btn btn-danger delete-exercise">
                                            Delete exercise
                                        </button>
                                        <button type="button" class="btn btn-primary add-exercise">
                                            Add exercise
                                        </button>
                                    </div>
                                </div>
                                <?php ++$i; ?>
                                <div class="col-6">
                                    @if (isset($trainingPlan->workouts[$i]))
                                        @php
                                            $workout = $trainingPlan->workouts[$i];
                                        @endphp
                                        @include('partials._filled-workout')
                                    @else
                                        @include('partials._empty-workout')
                                    @endif
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <button type="button" class="btn btn-danger delete-exercise">
                                            Delete exercise
                                        </button>
                                        <button type="button" class="btn btn-primary add-exercise">
                                            Add exercise
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <datalist id="exerciseList">
                    @foreach ($exercises as $exercise)
                        <option data-value="{{ $exercise->id }}" value="{{ $exercise->name }}">
                        </option>
                    @endforeach
                </datalist>
                <label class="form-label">Notes</label>
                <textarea name="notes" id="" cols="30" rows="10" class="form-control">{{ $trainingPlan->notes }}</textarea>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                <input type="hidden" name="user_id" value="{{ $userId }}">
            </form>
        </div>
    </div>
</x-layout>
