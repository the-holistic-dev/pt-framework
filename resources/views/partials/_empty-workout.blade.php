        <label class="form-label">
            Workout title
        </label>
        <input type="text" class="form-control" name="workout[{{ $i }}][title]"
            value="{{ old("workout.{$i}.title") ?? '' }}">
        @error("workout.{$i}.title")
            <span class="text-danger">
                {{ $message }}
            </span>
        @enderror
        <div class="d-flex justify-content-between align-items-end">
            <div>
                <label class="form-label">
                    Copy workout into day
                </label>
                <select class="form-select copy-workout-to">
                    <option value="0">1</option>
                    <option value="1">2</option>
                    <option value="2">3</option>
                    <option value="3">4</option>
                    <option value="4">5</option>
                    <option value="5">6</option>
                </select>
            </div>
            <div>
                <button type="button" class="btn btn-info copy-workout">
                    <i class="fas fa-copy"></i>
                    Copy workout
                </button>
            </div>
        </div>
        <label class="form-label">
            Exercises
        </label>
        <div class="accordion" id="workoutAccordion{{ $i }}">
            @include('partials._empty-workout-accordion')
        </div>
