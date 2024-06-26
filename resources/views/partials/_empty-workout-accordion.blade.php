@foreach ($orderLabels as $index => $label)
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseWorkout{{ $i }}Exercise{{ $index }}" aria-expanded="false"
                aria-controls="collapseWorkout{{ $i }}Exercise{{ $index }}">
                {{ $label }}
            </button>
        </h2>
        <div id="collapseWorkout{{ $i }}Exercise{{ $index }}" class="accordion-collapse collapse"
            data-bs-parent="#workoutAccordion{{ $i }}">
            <div class="accordion-body">
                <div class="d-grid mb-2">
                    <button type="button" class="btn btn-info copy-single-parameter">
                        <i class="fas fa-arrow-down"></i>
                        Copy parameter to next exercise
                    </button>
                    <button type="button" class="btn btn-info mt-2 copy-all-parameter">
                        <i class="fas fa-arrow-down-wide-short"></i>
                        Copy parameter to all exercise
                    </button>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">
                            Order
                        </label>
                        <input type="text" name="workout[{{ $i }}][parameter][{{ $index }}][order]"
                            class="form-control" value="{{ $label }}">
                        @error('workout.*.parameter.*.order')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-9">
                        <label class="form-label">
                            Exercise
                        </label>
                        <input type="text" list="exerciseList" class="form-control exercise-name" autocomplete="off"
                            placeholder="Enter the exercise name">
                        <input type="hidden" class="exercise-id"
                            name="workout[{{ $i }}][parameter][{{ $index }}][id]">
                        @error('workout.*.parameter.*.id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row gx-1">
                    <div class="col-3">
                        <label class="form-label">
                            Sets
                        </label>
                        <input type="text" name="workout[{{ $i }}][parameter][{{ $index }}][set]"
                            class="form-control">
                        @error('workout.*.parameter.*.set')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Reps
                        </label>
                        <input type="text" name="workout[{{ $i }}][parameter][{{ $index }}][rep]"
                            class="form-control">
                        @error('workout.*.parameter.*.rep')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Tempo
                        </label>
                        <input type="text"
                            name="workout[{{ $i }}][parameter][{{ $index }}][tempo]"
                            class="form-control">
                        @error('workout.*.parameter.*.tempo')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Rest
                        </label>
                        <input type="text"
                            name="workout[{{ $i }}][parameter][{{ $index }}][rest]"
                            class="form-control">
                        @error('workout.*.parameter.*.rest')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">
                            Technique
                        </label>
                        <input type="text"
                            name="workout[{{ $i }}][parameter][{{ $index }}][technique]"
                            class="form-control">
                        @error('workout.*.parameter.*.technique')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">
                            Note
                        </label>
                        <input type="text"
                            name="workout[{{ $i }}][parameter][{{ $index }}][note]"
                            class="form-control">
                        @error('workout.*.parameter.*.note')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
