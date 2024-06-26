<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Models\TemplateCategory;
use App\Models\TrainingTemplate;
use App\Models\ExerciseParameters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrainingTemplateController extends Controller
{

  public function create(Request $request)
  {
    $exercises = Exercise::all();
    $templates = TrainingTemplate::all();
    $templateId = $request->get('template');
    $template = TrainingTemplate::find($templateId);
    $categories = TemplateCategory::where('user_id', auth()->user()->id)->get();
    return view('training-templates.create', [
      'heading' => 'Create a new training template',
      'templates' => $templates,
      'template' => $template,
      'exercises' => $exercises,
      'categories' => $categories,
      'orderLabels' => ['A1', 'A2', 'B1', 'B2', 'C1', 'C2']
    ]);
  }

  public function store(Request $request)
  {
    ['training' => $trainingFields, 'workout' => $workoutFields, 'exercise' => $exerciseParametersFields] = $this->validateFields($request);
    $this->saveTemplate($trainingFields, $workoutFields, $exerciseParametersFields);
    return redirect("/training-templates/index");
  }

  public function edit()
  {
  }

  public function update()
  {
  }

  public function index(Request $request)
  {
    $templates = TrainingTemplate::where('user_id', auth()->user()->id)->get();
    $categories = TemplateCategory::where('user_id', auth()->user()->id)->get();
    if ($request->expectsJson()) {
      return response()->json($templates);
    } else {
      return view('training-templates.index', ['templates' => $templates, 'categories' => $categories]);
    }
  }

  public function show(Request $request, int|TrainingTemplate $template)
  {
    $template = TrainingTemplate::findOrFail($template);
    if ($request->expectsJson()) {
      return response()->json($template);
    } else {
      return view('training-templates.show', ['template' => $template]);
    }
  }

  public function destroy(TrainingTemplate $template)
  {
    $template->delete();
    return redirect('/training-templates/index');
  }

  public function getByCategory(int $category)
  {
    $templates = TrainingTemplate::where('user_id', 2)->where('template_category_id', $category)->get();
    return $templates;
  }

  private function validateFields(Request $request,)
  {
    $validFields = ['training' => [], 'workout' => [], 'exercise' => []];
    $validator = $this->createTemplateValidator($request);
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

  private function saveTemplate(array $trainingFields, array $workoutFields, array $exerciseParametersFields)
  {
    $trainingFields['user_id'] = auth()->user()->id;
    $newTemplateId = TrainingTemplate::create($trainingFields)->id;
    foreach ($workoutFields as $workoutIndex => $workoutField) {
      ['workout' => $workoutField] = $workoutField;
      $workoutField = array_shift($workoutField);
      $workoutField['training_template_id'] = $newTemplateId;
      $newWorkoutId = Workout::create($workoutField)->id;
      $parameters = $exerciseParametersFields[$workoutIndex];
      $this->createExerciseParameter($parameters, $newWorkoutId);
    }
  }

  private function createTemplateValidator(Request $request)
  {
    $rules = [
      'title' => 'required',
      'template_category_id' => 'required|exists:template_categories,id',
      'notes' => 'nullable',
    ];
    $vals = [
      'title' => $request->get('title'),
      'template_category_id' => $request->get('template_category_id'),
      'notes' => $request->get('notes'),
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
    foreach ($parameters as $parameterIndex => $parameterVals) {
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

  private function updateTemplate($workout, $fields)
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
