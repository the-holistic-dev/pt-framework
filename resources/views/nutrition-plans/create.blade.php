<x-layout>
    <div class="bg-black bg-black bg-pattern-2">
        @include('partials._nav')
        <div class="container-fluid py-10">
            <div class="row justify-content-center align-items-center">
                <div class="col-10 bg-white p-6 rounded">
                    <h1>{{ $heading }}</h1>
                    <form method="POST" action="{{ action('NutritionPlanController@store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label">
                                            Title
                                        </label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title') ?? '' }}">
                                        @error('title')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">
                                            Goal
                                        </label>
                                        <input type="text" name="goal" class="form-control"
                                            value="{{ old('goal') ?? '' }}">
                                        @error('goal')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end align-items-end">
                                <button title="Import template" type="button" class="btn btn-info me-3"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasTemplate"
                                    aria-controls="offcanvasTemplate">
                                    <i class="fas fa-file-import"></i> Import template
                                </button>
                                <a title="Reset form" href="{{ url()->current() }}" type="button" class="btn btn-info">
                                    <i class="fas fa-undo"></i> Reset form
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            @for ($i = 0; $i < 3; ++$i)
                                <div class="col-4">
                                    @php
                                        $day = $template->days[$i] ?? null;
                                    @endphp
                                    @if (!is_null($template) && isset($template->days[$i]))
                                        @include('partials._filled-meal')
                                    @else
                                        @include('partials._empty-meal')
                                    @endif
                                    <div class="d-flex align-items-center justify-content-between mt-2">
                                        <button type="button" class="btn btn-danger delete-meal">
                                            Delete meal
                                        </button>
                                        <button type="button" class="btn btn-primary add-meal">
                                            Add meal
                                        </button>
                                    </div>
                                    <div class="row day-macro-row">
                                        <p>
                                            Macros
                                        </p>
                                        <div class="col">
                                            <span>
                                                Proteins
                                            </span>
                                            <br>
                                            <span class="protein">
                                                {{ $day->macros->protein ?? 0 }}
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span>
                                                Fats
                                            </span>
                                            <br>
                                            <span class="fat">
                                                {{ $day->macros->fat ?? 0 }}
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span>
                                                Carbs
                                            </span>
                                            <br>
                                            <span class="carbohydrate">
                                                {{ $day->macros->carbohydrate ?? 0 }}
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span>
                                                Fibers
                                            </span>
                                            <br>
                                            <span class="fiber">
                                                {{ $day->macros->fiber ?? 0 }}
                                            </span>
                                        </div>
                                        <div class="col">
                                            <span>
                                                Calories
                                            </span>
                                            <br>
                                            <span class="calorie">
                                                {{ $day->macros->calorie ?? 0 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <label class="form-label">Notes</label>
                        <textarea name="notes" id="" cols="30" rows="10" class="form-control wysiwyg-editor"></textarea>
                        <x-btn type="submit" contextClass="btn-primary mt-3" text="Submit"></x-btn>
                        <input type="hidden" name="user_id" value="{{ $userId }}">
                    </form>
                </div>
                <datalist id="foodGroupList">
                    @foreach ($foodGroups as $group)
                        <option data-value="{{ $group->id }}" value="{{ $group->name }}"></option>
                    @endforeach
                </datalist>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasTemplate"
                    aria-labelledby="offcanvasTemplateLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasTemplateLabel">Templates</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="py-3">
                            <label for="templateCatSelect" class="form-label">
                                Filter by category
                            </label>
                            <select id="templateCatSelect" class="form-select" name="templateCat"
                                data-model="nutrition">
                                @foreach ($templateCats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <form method="GET" action="">
                            @csrf
                            <label class="form-label">Template list</label>
                            <select id="templateSelect" class="form-select" name="template">
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}">
                                        {{ $template->title }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="d-grid mt-2">
                                <x-btn type="submit" contextClass="btn-primary" text="Submit"></x-btn>
                            </div>
                            <input type="hidden" name="userId" value="{{ $userId }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-layout>
