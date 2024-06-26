<x-layout>
    @include('partials._nav')
    <div class="bg-black bg-pattern-2">
        <div class="container-fluid py-15">
            <div class="row">
                <div class="col-lg-3">
                    <div class="bg-dark text-white p-3 rounded">
                        <p class="fs-1">
                            {{ $user->name }}
                        </p>
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#trainingTab"
                                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                    Training
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#nutritionTab" type="button"
                                    role="tab" aria-controls="home-tab-pane" aria-selected="false">
                                    Nutrition
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#infoTab" type="button"
                                    role="tab" aria-controls="home-tab-pane" aria-selected="false">
                                    Informations
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content bg-white p-3 rounded">
                        <div class="tab-pane fade show active" id="trainingTab" role="tabpanel"
                            aria-labelledby="trainingTab" tabindex="0">
                            <a href="{{ action('TrainingPlanController@create', ['userId' => $user->id]) }}"
                                class="btn btn-primary">
                                Add training
                            </a>
                            <table class="table table-striped caption-top">
                                <caption>Training plans</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Title
                                        </th>
                                        <th scope="col">
                                            Goal
                                        </th>
                                        <th scope="col">
                                            Phase
                                        </th>
                                        <th scope="col">
                                            Actions
                                        </th>
                                        <th scope="col">
                                            Downloads
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trainingPlans as $trainingPlan)
                                        <tr>
                                            <td>
                                                {{ $trainingPlan->title }}
                                            </td>
                                            <td>
                                                {{ $trainingPlan->goal }}
                                            </td>
                                            <td>
                                                {{ $trainingPlan->phase }}
                                            </td>
                                            <td>
                                                <a href="/trainings/{{ $trainingPlan->id }}"
                                                    class="btn btn-primary px-2 py-0">
                                                    View
                                                </a>
                                                <form method="GET"
                                                    action="{{ action('TrainingPlanController@edit', ['trainingPlan' => $trainingPlan, 'userId' => $user->id]) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-warning px-2 py-0" type="submit">
                                                        Edit
                                                    </button>
                                                    <input type="hidden" name="userId"
                                                        value="{{ $trainingPlan->user_id }}">
                                                </form>
                                                <form method="POST" action="/trainings/{{ $trainingPlan->id }}/"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger px-2 py-0" type="submit">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary px-2 py-0">Download training</button>
                                                <button class="btn btn-info px-2 py-0">Download weight log</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nutritionTab" role="tabpanel" aria-labelledby="nutritionTab"
                            tabindex="0">
                            <a href="{{ action('NutritionPlanController@create', ['userId' => $user->id]) }}"
                                class="btn btn-primary">
                                Add nutrition plan
                            </a>
                            <table class="table table-striped caption-top">
                                <caption>Nutrition plans</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            Title
                                        </th>
                                        <th scope="col">
                                            Goal
                                        </th>
                                        <th scope="col">
                                            Actions
                                        </th>
                                        <th scope="col">
                                            Downloads
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nutritionPlans as $nutritionPlan)
                                        <tr>
                                            <td>
                                                {{ $nutritionPlan->title }}
                                            </td>
                                            <td>
                                                {{ $nutritionPlan->goal }}
                                            </td>
                                            <td>
                                                <a href="/trainings/{{ $nutritionPlan->id }}"
                                                    class="btn btn-primary px-2 py-0">
                                                    View
                                                </a>
                                                <form method="GET"
                                                    action="/nutrition-plans/{{ $nutritionPlan->id }}/edit"
                                                    class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-warning px-2 py-0" type="submit">
                                                        Edit
                                                    </button>
                                                    <input type="hidden" name="userId"
                                                        value="{{ $nutritionPlan->user_id }}">
                                                </form>
                                                <form method="POST"
                                                    action="/nutrition-plans/{{ $nutritionPlan->id }}/"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger px-2 py-0" type="submit">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary px-2 py-0">Download training</button>
                                                <button class="btn btn-info px-2 py-0">Download weight log</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="infoTab" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">
                            User Informations
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
