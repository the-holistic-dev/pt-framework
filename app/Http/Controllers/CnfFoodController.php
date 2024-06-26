<?php

namespace App\Http\Controllers;

use App\Models\CnfFood;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCnfFoodRequest;
use App\Http\Requests\UpdateCnfFoodRequest;
use Illuminate\Contracts\Database\Query\Builder;

class CnfFoodController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreCnfFoodRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCnfFoodRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\int|CnfFood  $cnfFood
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, string|CnfFood $cnfFood)
  {
    return response()->json(CnfFood::findOrFail($cnfFood));
    /* if ($request->expectsJson()) {
      return response()->json($template);
    } else {
      return view('training-templates.show', ['template' => $template]);
    } */
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CnfFood  $cnfFood
   * @return \Illuminate\Http\Response
   */
  public function edit(CnfFood $cnfFood)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCnfFoodRequest  $request
   * @param  \App\Models\CnfFood  $cnfFood
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCnfFoodRequest $request, CnfFood $cnfFood)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CnfFood  $cnfFood
   * @return \Illuminate\Http\Response
   */
  public function destroy(CnfFood $cnfFood)
  {
    //
  }

  public function get(string $search)
  {
    if (str_contains($search, ' ')) {
      $search = explode(' ', $search);
      $foods = CnfFood::where(function (Builder $query) use ($search) {
        foreach ($search as $key => $term) {
          $query->orWhere('name', 'LIKE', "%{$term}%");
        }
      });
      return response()->json($foods->get()->toArray());
    } else {
      return response()->json(CnfFood::where('name', 'LIKE', "%{$search}%")->get()->toArray());
    }
  }
}
