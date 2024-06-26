<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Exercise;
use App\Models\TrainingPlan;
use App\Models\TrainingTemplate;
use App\Models\ExerciseParameters;
use App\Models\TemplateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingPlanController extends Controller
{

  public function create(Request $request)
  {
    $templateId = $request->get('template');
    $template = TrainingTemplate::find($templateId);
    $exercises = Exercise::all();
    $templateCats = TemplateCategory::where('user_id', auth()->user()->id)->get();
    $templates = TrainingTemplate::where('user_id', auth()->user()->id)->where('template_category_id', $templateCats->first()->id)->get();
    return view('trainings.create', [
      'heading' => 'Create a new training plan',
      'templateCats' => $templateCats,
      'templates' => $templates,
      'template' => $template,
      'exercises' => $exercises,
      'userId' => $request->get('userId'),
      'orderLabels' => ['A1', 'A2', 'B1', 'B2', 'C1', 'C2']
    ]);
  }

  public function index()
  {
    return view('trainings.index', ['plans' => TrainingPlan::all()]);
  }

  public function show(TrainingPlan $trainingPlan)
  {
    return view('trainings.show', ['trainingPlan' => $trainingPlan]);
  }

  public function edit(TrainingPlan $trainingPlan)
  {
    $exercises = Exercise::all();
    return view('trainings.edit', [
      'heading' => 'Edit training plan',
      'orderLabels' => ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'],
      'exercises' => $exercises,
      'trainingPlan' => $trainingPlan,
      'userId' => $trainingPlan->user->id
    ]);
  }

  public function store(Request $request)
  {
    ['training' => $trainingFields, 'workout' => $workoutFields, 'exercise' => $exerciseParametersFields] = $this->validateFields($request);
    $this->saveTraining($trainingFields, $workoutFields, $exerciseParametersFields);
    return redirect("/user/{$trainingFields['user_id']}");
  }

  public function update(Request $request, TrainingPlan $trainingPlan)
  {
    ['training' => $trainingFields, 'workout' => $workoutFields, 'exercise' => $exerciseParametersFields] = $this->validateFields($request);
    $this->updateTraining($trainingPlan, $trainingFields, $workoutFields, $exerciseParametersFields);
    return redirect("/user/{$trainingPlan->user_id}");
  }

  public function destroy(TrainingPlan $trainingPlan)
  {
    $trainingPlan->delete();
    return redirect("/user/{$trainingPlan->user_id}");
  }

  private function validateFields(Request $request)
  {
    $validFields = ['training' => [], 'workout' => [], 'exercise' => []];
    $validator = $this->createTrainingPlanValidator($request);
    $validator->validate();
    $trainingFields = $validator->validated();
    $workoutFields = [];
    $exerciseParametersFields = [];
    foreach ($request->get('workout') as $key => $value) {
      ['parameter' => $parameterArray] = $value;
      if (!$this->allExerciseAreEmpty($parameterArray)) {
        //Validate workout fields
        $validator = $this->createWorkoutValidator($key, $request);
        $validator->validate();
        $workoutFields[] = $validator->validated();
        //Validate exercise fields
        $validator = $this->createExerciseValidator($request, $key, $parameterArray);
        $validParameters = $validator->validate();
        ['workout' => $x] = $validParameters;
        ['parameter' => $x] = array_shift($x);
        $exerciseParametersFields[] = $x;
      }
    }
    $validFields['training'] = $trainingFields;
    $validFields['workout'] = $workoutFields;
    $validFields['exercise'] = $exerciseParametersFields;
    return $validFields;
  }

  private function saveTraining(array $trainingFields, array $workoutFields, array $exerciseParametersFields)
  {
    $newTrainingId = TrainingPlan::create($trainingFields)->id;
    foreach ($workoutFields as $workoutIndex => $workoutField) {
      ['workout' => $workoutField] = $workoutField;
      $workoutField = array_shift($workoutField);
      $workoutField['training_plan_id'] = $newTrainingId;
      $newWorkoutId = Workout::create($workoutField)->id;
      $parameters = $exerciseParametersFields[$workoutIndex];
      $this->createExerciseParameter($parameters, $newWorkoutId);
    }
  }

  private function updateTraining(TrainingPlan $trainingPlan, array $trainingFields, array $workoutFields, array $exerciseParametersFields)
  {
    $trainingPlan->title = $trainingFields['title'];
    $trainingPlan->goal = $trainingFields['goal'];
    $trainingPlan->phase = $trainingFields['phase'];
    $trainingPlan->notes = $trainingFields['notes'];
    $trainingPlan->save();

    foreach ($workoutFields as $workoutIndex => $workoutField) {
      if ($this->workoutExist($trainingPlan, $workoutIndex)) {
        $workout = $trainingPlan->workouts[$workoutIndex];
        $this->updateWorkout($workout, $workoutField);
        $this->deleteAllWorkoutExerciseParameter($workout);
      } else {
        ['workout' => $x] = $workoutField;
        $workoutField = array_shift($x);
        $workoutField['training_plan_id'] = $trainingPlan->id;
        $workout = Workout::create($workoutField);
        $parameters = $exerciseParametersFields[$workoutIndex];
      }
      $parameters = $exerciseParametersFields[$workoutIndex];
      $this->createExerciseParameter($parameters, $workout->id);
    }

    $workoutsToDelete = array_keys(array_diff_key($trainingPlan->workouts()->get()->toArray(), $workoutFields));
    if (!empty($workoutsToDelete)) {
      foreach ($workoutsToDelete as $index) {
        $trainingPlan->workouts[$index]->delete();
      }
    }
  }

  private function createTrainingPlanValidator(Request $request)
  {
    $rules = [
      'title' => 'required',
      'goal' => 'required',
      'phase' => 'required',
      'notes' => 'nullable',
      'user_id' => 'required'
    ];
    $vals = [
      'title' => $request->get('title'),
      'goal' => $request->get('goal'),
      'phase' => $request->get('phase'),
      'notes' => $request->get('notes'),
      'user_id' => $request->get('user_id')
    ];

    return Validator::make($vals, $rules);
  }

  private function createWorkoutValidator(int $workoutIndex, Request $request)
  {
    $rules = [
      "workout.{$workoutIndex}.title" => 'required'
    ];
    return Validator::make($request->all(), $rules, ['required' => 'The workout title field is required']);
  }

  private function createExerciseValidator(Request $request, int $workoutIndex, array $parameters)
  {
    $rules = [];
    $parameterKeys = array_keys($parameters);
    foreach ($parameterKeys as $parameterIndex) {
      $rules['workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.id'] = 'nullable|exists:exercises,id';
      $rules['workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.order'] = 'required_with:workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.id';
      $rules['workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.set'] = 'required_with:workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.id';
      $rules['workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.rep'] = 'required_with:workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.id';
      $rules['workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.tempo'] = 'required_with:workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.id';
      $rules['workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.rest'] = 'required_with:workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.id';
      $rules['workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.technique'] = 'nullable';
      $rules['workout.' . $workoutIndex . '.parameter.' . $parameterIndex . '.note'] = 'nullable';
    }
    return Validator::make($request->all(), $rules, ['required_with' => 'This field is required when an exercise is selected']);
  }

  private function createExerciseParameter($parameters, $newWorkoutId)
  {
    foreach ($parameters as $parameterArray) {
      if (!is_null($parameterArray['id'])) {
        ExerciseParameters::create([
          'order' => $parameterArray['order'],
          'set' => $parameterArray['set'],
          'rep' => $parameterArray['rep'],
          'tempo' => $parameterArray['tempo'],
          'rest' => $parameterArray['rest'],
          'technique' => $parameterArray['technique'],
          'note' => $parameterArray['note'],
          'exercise_id' => $parameterArray['id'],
          'workout_id' => $newWorkoutId,
        ]);
      }
    }
  }

  private function updateWorkout($workout, $fields)
  {
    ['workout' => $fields] = $fields;
    $fields = array_shift($fields);
    $workout->title = $fields['title'];
    $workout->save();
  }

  private function workoutExist($trainingPlan, $workoutIndex)
  {
    return isset($trainingPlan->workouts[$workoutIndex]);
  }

  private function allExerciseAreEmpty($exerciseParameters)
  {
    $exerciseParameters = array_map('array_filter', $exerciseParameters);
    $exerciseParameters = array_filter($exerciseParameters);
    foreach ($exerciseParameters as $exerciseParameter) {
      if (array_key_exists('id', $exerciseParameter)) {
        return false;
      }
    }
    return true;
  }

  private function deleteAllWorkoutExerciseParameter($workout)
  {
    foreach ($workout->exercises as $exerciseParameter) {
      $exerciseParameter->delete();
    }
  }
}
