<x-layout>
    @include('partials._nav')
    <div class="container bg-white p-4 rounded my-5">
        <h1>{{ $heading }}</h1>
        <form method="POST" action="{{ action('TrainingTemplateController@store') }}">
            @csrf
            <div class="row justify-content-end">
                <div class="col-3">
                    <button title="Import template" type="button" class="btn btn-info" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasTemplate" aria-controls="offcanvasTemplate">
                        <i class="fas fa-file-import"></i> Import template
                    </button>
                    <a title="Reset form" href="{{ url()->current() }}" type="button" class="btn btn-info">
                        <i class="fas fa-undo"></i> Reset form
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label class="form-label">
                        Title
                    </label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') ?? '' }}">
                    @error('title')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-4">
                    <label class="form-label">
                        Category
                    </label>
                    <div class="row gx-0">
                        <div class="col-lg-11">
                            <select type="text" name="template_category_id" class="form-select"
                                value="{{ old('template_category_id') ?? '' }}">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-1">
                            <button type="button" id="addCatBtn" class="btn btn-info">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <label class="form-label">
                        Phase
                    </label>
                    <select class="form-select" name="phase">
                        <option>Accumulation</option>
                        <option>Intensification</option>
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
                                @if (!is_null($template) && isset($template->workouts[$i]))
                                    @php
                                        $workout = $template->workouts[$i];
                                    @endphp
                                    @include('partials._template-filled-workout')
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
                                @if (!is_null($template) && isset($template->workouts[$i]))
                                    @php
                                        $workout = $template->workouts[$i];
                                    @endphp
                                    @include('partials._template-filled-workout')
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
            <datalist id="techniqueList">
                @foreach ($exercises as $exercise)
                    <option data-value="{{ $exercise->id }}" value="{{ $exercise->name }}">
                    </option>
                @endforeach
            </datalist>
            <label class="form-label">Notes</label>
            <textarea name="notes" id="" cols="30" rows="10" class="form-control"></textarea>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasTemplate"
            aria-labelledby="offcanvasTemplateLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasTemplateLabel">Templates</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form method="GET" action="{{ action('TrainingTemplateController@create') }}">
                    @csrf
                    <label class="form-label">Template list</label>
                    <select class="form-select" name="template">
                        @foreach ($templates as $template)
                            <option value="{{ $template->id }}">
                                {{ $template->title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary">
                            Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
