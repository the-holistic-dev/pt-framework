@php
    use App\Models\Exercise;
@endphp
@foreach ($workout->exercises as $index => $parameter)
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseWorkout{{ $i }}Exercise{{ $index }}" aria-expanded="false"
                aria-controls="collapseWorkout{{ $i }}Exercise{{ $index }}">
                {{ $parameter->order }}
                {{ Exercise::find($parameter->exercise_id)->name }}
            </button>
        </h2>
        <div id="collapseWorkout{{ $i }}Exercise{{ $index }}" class="accordion-collapse collapse"
            data-bs-parent="#workoutAccordion{{ $i }}">
            <div class="accordion-body">
                <div class="d-grid mb-2">
                    <button class="btn btn-info">
                        <i class="fas fa-arrow-down copy-next"></i>
                        Copy parameter to next exercise
                    </button>
                    <button class="btn btn-info mt-2 copy-all">
                        <i class="fas fa-arrow-down-wide-short"></i>
                        Copy parameter to all exercise
                    </button>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">
                            Order
                        </label>
                        <input type="text"
                            name="workout[{{ $i }}][parameter][{{ $index }}][order]"
                            class="form-control" value="{{ $parameter->order }}">
                        @error('workout.*.parameter.*.order')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">
                            Exercise
                        </label>
                        <input type="text" list="exerciseList"
                            name="workout[{{ $i }}][parameter][{{ $index }}][id]"
                            class="form-control exercise-name" autocomplete="off" placeholder="Enter the exercise name"
                            value="{{ Exercise::find($parameter->exercise_id)->name }}">
                        <input type="hidden" class="exercise-id"
                            name="workout[{{ $i }}][parameter][{{ $index }}][id]"
                            value="{{ $parameter->exercise_id }}">
                        @error('workout.*.parameter.*.id')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <label class="form-label">
                            Sets
                        </label>
                        <input type="text" name="workout[{{ $i }}][parameter][{{ $index }}][set]"
                            class="form-control" value="{{ $parameter->set }}">
                        @error('workout.*.parameter.*.set')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Reps
                        </label>
                        <input type="text" name="workout[{{ $i }}][parameter][{{ $index }}][rep]"
                            class="form-control" value="{{ $parameter->rep }}">
                        @error('workout.*.parameter.*.rep')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Tempo
                        </label>
                        <input type="text"
                            name="workout[{{ $i }}][parameter][{{ $index }}][tempo]"
                            class="form-control" value="{{ $parameter->tempo }}">
                        @error('workout.*.parameter.*.tempo')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <label class="form-label">
                            Rest
                        </label>
                        <input type="text"
                            name="workout[{{ $i }}][parameter][{{ $index }}][rest]"
                            class="form-control" value="{{ $parameter->rest }}">
                        @error('workout.*.parameter.*.rest')
                            <p>
                                {{ $message }}
                            </p>
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
                            class="form-control" value="{{ $parameter->technique }}">
                        @error('workout.*.parameter.*.technique')
                            <p>
                                {{ $message }}
                            </p>
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
                            class="form-control" value="{{ $parameter->note }}">
                        @error('workout.*.parameter.*.note')
                            <p>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
