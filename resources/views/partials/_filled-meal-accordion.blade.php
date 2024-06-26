@php
    use App\Models\CnfFood;
    use App\Models\CnfFoodGroup;
@endphp
@foreach ($day->meals as $mealIndex => $meal)
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseDay{{ $i }}Meal{{ $mealIndex }}" aria-expanded="false"
                aria-controls="collapseDay{{ $i }}Meal{{ $mealIndex }}">
                {{ $meal->name }}
            </button>
        </h2>
        <div id="collapseDay{{ $i }}Meal{{ $mealIndex }}" class="accordion-collapse collapse"
            data-bs-parent="#day{{ $i }}Accordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">
                            Meal name
                        </label>
                        <input type="text" name="day[{{ $i }}][meal][{{ $mealIndex }}][name]"
                            class="form-control meal-name" value="{{ $meal->name }}">
                        @error('day.*.meal.*.name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                @foreach ($meal->foods as $foodIndex => $food)
                    <div class="row food-row">
                        <div class="col-12">
                            <div class="row px-0">
                                <div class="col-12">
                                    <label class="form-label {{ !is_null($food->cnf_food_group_id) ?: 'd-none' }}">
                                        Food group
                                    </label>
                                    <input type="text" list="foodGroupList"
                                        class="form-control group-name {{ !is_null($food->cnf_food_group_id) ?: 'd-none' }}"
                                        placeholder="Enter the group name..."
                                        value="{{ is_null($food->cnf_food_group_id) ?: CnfFoodGroup::where('food_group_id', $food->cnf_food_group_id)->first()->name }}">
                                    @error('day.*.meal.*.group.name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <input type="hidden" class="group-id"
                                        name="day[{{ $i }}][meal][{{ $mealIndex }}][group][{{ $foodIndex }}][id]"
                                        value="{{ $food->cnf_food_group_id ? CnfFoodGroup::where('food_group_id', $food->cnf_food_group_id)->first()->id : '' }}"
                                        {{ $food->cnf_food_group_id ?? 'disabled' }}>
                                    <span class="food-not-found text-danger d-none">
                                        We didn't find any group matching your input
                                    </span>
                                    <label class="form-label {{ !is_null($food->cnf_food_id) ?: 'd-none' }}">
                                        Food
                                    </label>
                                    <input type="text" list="foodList"
                                        class="form-control auto-complete {{ !is_null($food->cnf_food_id) ?: 'd-none' }}"
                                        placeholder="Enter the food name..."
                                        {{ !is_null($food->cnf_food_id) ?: 'disabled' }}
                                        value="{{ is_null($food->cnf_food_id) ? '' : CnfFood::where('cnf_food_id', $food->cnf_food_id)->first()->name }}">
                                    <span class="group-not-found text-danger d-none">
                                        We didn't find any food matching your input
                                    </span>
                                    <input type="hidden" class="food-id"
                                        name="day[{{ $i }}][meal][{{ $mealIndex }}][food][{{ $foodIndex }}][id]"
                                        {{ !is_null($food->cnf_food_id) ?: 'disabled' }}
                                        value="{{ $food->cnf_food_id ? CnfFood::where('cnf_food_id', $food->cnf_food_id)->first()->id : '' }}">
                                    @error('day.*.meal.*.food.name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">
                                Portion
                            </label>
                            <select class="form-select portion-select"
                                name="day[{{ $i }}][meal][{{ $mealIndex }}][food][{{ $foodIndex }}][portion]"
                                {{ !is_null($food->cnf_food_id) ?: 'disabled' }}>
                                @if (!is_null($food->cnf_food_id))
                                    @foreach ($food->factors as $factor)
                                        <option value="{{ $factor->id }}" data-factor="{{ $factor->factor }}"
                                            {{ $food->cnf_food_measure_id == $factor->cnf_food_measure_id ? 'selected' : '' }}>
                                            {{ $factor->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">
                                Type
                            </label>
                            <select class="form-select food-type-select">
                                <option value="group" {{ $food->cnf_food_id ?? 'selected' }}>
                                    Group
                                </option>
                                <option value="food" {{ $food->cnf_food_group_id ?? 'selected' }}>
                                    Food
                                </option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">
                                Quantity
                            </label>
                            <input type="text"
                                name="day[{{ $i }}][meal][{{ $mealIndex }}][group][{{ $foodIndex }}][quantity]"
                                class="form-control quantity {{ $food->cnf_food_group_id ?? 'd-none' }}"
                                value="{{ $food->quantity }}" {{ !is_null($food->cnf_food_group_id) ?: 'disabled' }}>
                            <input type="text"
                                name="day[{{ $i }}][meal][{{ $mealIndex }}][food][{{ $foodIndex }}][quantity]"
                                class="form-control quantity {{ $food->cnf_food_id ?? 'd-none' }}"
                                value="{{ $food->quantity }}" {{ !is_null($food->cnf_food_id) ?: 'disabled' }}>
                        </div>
                    </div>
                @endforeach
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
                            {{ $meal->macros->protein ?? 0 }}
                        </span>
                    </div>
                    <div class="col">
                        <span>
                            Fats
                        </span>
                        <br>
                        <span class="fat">
                            {{ $meal->macros->fat ?? 0 }}
                        </span>
                    </div>
                    <div class="col">
                        <span>
                            Carbs
                        </span>
                        <br>
                        <span class="carbohydrate">
                            {{ $meal->macros->carbohydrate ?? 0 }}
                        </span>
                    </div>
                    <div class="col">
                        <span>
                            Fibers
                        </span>
                        <br>
                        <span class="fiber">
                            {{ $meal->macros->fiber ?? 0 }}
                        </span>
                    </div>
                    <div class="col">
                        <span>
                            Calories
                        </span>
                        <br>
                        <span class="calorie">
                            {{ $meal->macros->calorie ?? 0 }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
