<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\GameResult;
use OmgGame\Models\ResultCondition;

class ResultConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $result_id
     * @return Response
     */
    public function index($result_id)
    {
        $result = GameResult::find($result_id);
        if (!isset($result)) return redirect()->back()->with('flash_warning', 'Result not found');

        $conditions = ResultCondition::where('result_id', $result_id)->paginate();

        $params = [
            'conditions' => $conditions,
            'result' => $result
        ];

        return view('admin.resultConditions.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($result_id)
    {
        $result = GameResult::find($result_id);
        if (!isset($result)) return redirect()->back()->with('flash_warning', 'Result not found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
