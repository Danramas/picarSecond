<?php

namespace App\Http\Controllers;

use App\Advert;
use App\CarMark;
use App\CarModel;
use App\CarModification;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $marks=CarMark::all();
        return view('search', ['marks'=>$marks]);
    }

    public function models(Request $request)
    {
        $data = CarModel::with('mark')->where('mark_id', $request->id)->get();
        return response()->json($data);
    }

    public function modifications(Request $request)
    {
        $data = CarModification::with('model')->where('model_id', $request->id)->get();
        return response()->json($data);
    }

    public function searching(Request $request)
    {
        $minYear = null;
        $maxYear = null;
        $carId = null;
        if (!empty($request->mark_id)) {
            $models = CarModel::where('mark_id', $request->mark_id)->select('id')->get();
            $carId= CarModification::whereIN('model_id', $models)->select('id')->get();
        }

        if (!empty($request->model_id)) {
            $carId = CarModification::where('model_id', $request->model_id)->select('id')->get();
        }

        if (!empty($request->modification_id)) {
            $carId = CarModification::whereId($request->modification_id)->select('id')->get();
        }

        if (!empty($request->minYear)) {
            $minYear = $request->minYear;
        }
        if (!empty($request->maxYear)) {
            $maxYear = $request->maxYear;
        }

        if ($request->checkImage == 0) {
            $sign = '=';
        } else {
            $sign = '!=';
        }

        $getAdverts = Advert::with('modification.model.mark')
                            ->where('img1', $sign, null)
                            ->orderBy('created_at', 'DESC')
                            ->when($minYear, function ($query, $minYear) {
                                return $query->where('year', '>=', $minYear);
                            })
                            ->when($maxYear, function ($query, $maxYear) {
                                return $query->where('year', '<=', $maxYear);
                            })
                            ->when($carId, function ($query, $carId) {
                                return $query->whereIN('modification_id', $carId);
                            })
                            ->get();

        $adverts=[];
        foreach ($getAdverts as $advert) {
            $adverts[] = [
                'id'=>$advert->id,
                'markName'=>$advert->modification->model->mark->markName,
                'modelName'=>$advert->modification->model->modelName,
                'modificationName'=>$advert->modification->modificationName,
                'year'=>$advert->year,
                'img1'=>$advert->img1,
                'created_at'=>$advert->created_at->format('d-m-Y')
            ];
        }
        return response()->json($adverts);
    }
}
