<label class="form-label">
    Day title
</label>
<input type="text" class="form-control" name="day[{{ $i }}][title]"
    value="{{ old("day.{$i}.title") ?? $day->title }}">
@error("day.{$i}.title")
    <span class="text-danger">
        {{ $message }}
    </span>
@enderror
<div class="d-flex justify-content-between align-items-end">
    <div>
        <label class="form-label">
            Copy current into day
        </label>
        <select class="form-select copy-workout-to">
            <option value="0">1</option>
            <option value="1">2</option>
            <option value="2">3</option>
        </select>
    </div>
    <div>
        <button type="button" class="btn btn-info copy-workout">
            <i class="fas fa-copy"></i>
            Copy day
        </button>
    </div>
</div>
<label class="form-label">
    Meals
</label>
<div class="accordion" id="day{{ $i }}Accordion">
    @if ($day->meals->isNotEmpty())
        @include('partials._filled-meal-accordion')
    @else
        @include('partials._empty-meal-accordion')
    @endif
</div>
