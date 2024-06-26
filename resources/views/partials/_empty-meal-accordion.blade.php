@foreach ($mealLabels as $index => $label)
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseDay{{ $i }}Meal{{ $index }}" aria-expanded="false"
                aria-controls="collapseDay{{ $i }}Meal{{ $index }}">
                {{ $label }}
            </button>
        </h2>
        <div id="collapseDay{{ $i }}Meal{{ $index }}" class="accordion-collapse collapse"
            data-bs-parent="#day{{ $i }}Accordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">
                            Meal name
                        </label>
                        <input type="text" name="day[{{ $i }}][meal][{{ $index }}][name]"
                            class="form-control meal-name" value="{{ $label }}">
                        @error('day.*.meal.*.name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row food-row">
                    <div class="col-12">
                        <div class="row px-0">
                            <div class="col-12">
                                <label class="form-label">
                                    Food group
                                </label>
                                <input type="text" list="foodGroupList" class="form-control group-name"
                                    placeholder="Enter the group name...">
                                @error('day.*.meal.*.group.name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <input type="hidden" class="group-id"
                                    name="day[{{ $i }}][meal][{{ $index }}][group][0][id]">
                                <span class="food-not-found text-danger d-none">
                                    We didn't find any group matching your input
                                </span>
                                <label class="form-label d-none">
                                    Food
                                </label>
                                <input type="text" class="form-control food-name d-none auto-complete"
                                    placeholder="Enter the food name..." disabled>
                                <span class="group-not-found text-danger d-none">
                                    We didn't find any food matching your input
                                </span>
                                <input type="hidden" class="food-id"
                                    name="day[{{ $i }}][meal][{{ $index }}][food][0][id]" disabled>
                                @error('day.*.meal.*.food.name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label">
                            Type
                        </label>
                        <select class="form-select food-type-select">
                            <option value="group">Group</option>
                            <option value="food">Food</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">
                            Quantity
                        </label>
                        <input type="text"
                            name="day[{{ $i }}][meal][{{ $index }}][group][0][quantity]"
                            class="form-control quantity" value="1">
                        <input type="text"
                            name="day[{{ $i }}][meal][{{ $index }}][food][0][quantity]"
                            class="form-control quantity d-none" value="1" disabled>
                    </div>
                    <div class="col-12">
                        <label for="" class="form-label">
                            Portion
                        </label>
                        <select class="form-select portion-select"
                            name="day[{{ $i }}][meal][{{ $index }}][food][0][portion]"
                            disabled></select>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-2">
                    <button type="button" class="btn btn-danger delete-food">
                        Delete food
                    </button>
                    <button type="button" class="btn btn-primary add-food">
                        Add food
                    </button>
                </div>
                <div class="row meal-macro-row">
                    <div class="col">
                        <span>
                            Proteins
                        </span>
                        <br>
                        <span class="protein">
                            0
                        </span>
                    </div>
                    <div class="col">
                        <span>
                            Fats
                        </span>
                        <br>
                        <span class="fat">
                            0
                        </span>
                    </div>
                    <div class="col">
                        <span>
                            Carbs
                        </span>
                        <br>
                        <span class="carbohydrate">
                            0
                        </span>
                    </div>
                    <div class="col">
                        <span>
                            Fibers
                        </span>
                        <br>
                        <span class="fiber">
                            0
                        </span>
                    </div>
                    <div class="col">
                        <span>
                            Calories
                        </span>
                        <br>
                        <span class="calorie">
                            0
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
