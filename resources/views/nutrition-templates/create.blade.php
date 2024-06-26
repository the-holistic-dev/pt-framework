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
                                        {{ $day->macros->carb ?? 0 }}
                                    </span>
                                </div>
                                <div class="col">
                                    <span>
                                        Fibres
                                    </span>
                                    <br>
                                    <span class="fibre">
                                        {{ $day->macros->fibre ?? 0 }}
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
        </div>
    </div>
    </div>
    </div>
</x-layout>
