<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemplateCategory;
use App\Http\Requests\UpdateTemplateCategoryRequest;

class TemplateCategoryController extends Controller
{
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    ['data' => $fields] = $request->all();
    $fields['user_id'] = auth()->user()->id;
    return TemplateCategory::create($fields);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateTemplateCategoryRequest  $request
   * @param  \App\Models\TemplateCategory  $category
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateTemplateCategoryRequest $request, TemplateCategory $category)
  {
    ['name' => $name, 'user_id' => $userId] = $request->validated();
    $category->name = $name;
    $category->user_id = $userId;
    $category->save();

    return redirect('/training-templates/index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\TemplateCategory  $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(TemplateCategory $category)
  {
    if ($category->id != 1) {
      $category->delete();
    }
    return redirect("/training-templates/index");
  }
}
