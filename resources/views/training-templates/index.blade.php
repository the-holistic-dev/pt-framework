@php
    use App\Models\TemplateCategory;
@endphp
<x-layout>
    @include('partials._nav')
    <div class="bg-black bg-pattern-2">
        <div class="container-fluid py-12">
            <div class="row">
                <div class="col-lg-3">
                    <div class="bg-white p-3 rounded">
                        <button id="addCatBtn" href="{{ action('TrainingTemplateController@create') }}"
                            class="btn btn-primary">
                            Add category
                        </button>
                        <table class="table table-striped caption-top">
                            <caption>
                                Categories
                            </caption>
                            <thead>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            <form method="POST" action="/template-categories/{{ $category->id }}"
                                                class="d-inline-block">
                                                @csrf
                                                @method('PUT')
                                                <button class="edit-category btn btn-warning px-2 py-0" type="button">
                                                    Edit
                                                </button>
                                                <input type="hidden" name="name">
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            </form>
                                            <form method="POST" action="/template-categories/{{ $category->id }}"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="delete-category btn btn-danger px-2 py-0" type="button">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="bg-white p-3 rounded">
                        <a href="{{ action('TrainingTemplateController@create') }}" class="btn btn-primary">
                            Add template
                        </a>
                        <table class="table table-striped caption-top">
                            <caption>
                                Training template
                            </caption>
                            <thead>
                                <tr>
                                    <th>
                                        Title
                                    </th>
                                    <th>
                                        Category
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($templates as $template)
                                    <tr>
                                        <td>
                                            {{ $template->title }}
                                        </td>
                                        <td>
                                            {{ TemplateCategory::find($template->template_category_id)->name }}
                                        </td>
                                        <td>
                                            <a href="/training-templates/{{ $template->id }}"
                                                class="btn btn-primary px-2 py-0">
                                                View
                                            </a>
                                            <form method="GET"
                                                action="{{ action('TrainingTemplateController@edit', ['template' => $template]) }}"
                                                class="d-inline">
                                                @csrf
                                                <button class="btn btn-warning px-2 py-0" type="submit">
                                                    Edit
                                                </button>
                                            </form>
                                            <form method="POST" action="/training-templates/{{ $template->id }}/"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger px-2 py-0" type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
