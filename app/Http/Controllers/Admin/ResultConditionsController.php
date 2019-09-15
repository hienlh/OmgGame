<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\GameResult;
use OmgGame\Models\InfoForm;
use OmgGame\Models\Operator;
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
        $result = GameResult::findOrFail($result_id);

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
     * @param $result_id
     * @return void
     */
    public function create($result_id)
    {
        $result = GameResult::findOrFail($result_id);
        $forms = InfoForm::all();
        $operators = Operator::getAll();

        $params = [
            'result' => $result,
            'forms' => $forms,
            'operators' => $operators
        ];

        return view('admin.resultConditions.create', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $result_id
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request, $result_id)
    {
        $this->validate($request, [
            'key' => 'required',
            'condition' => 'required'
        ]);

        if (ResultCondition::where('result_id', $result_id)
            ->where('key', $request->input('key'))->first()) {
            return redirect()->back()->withInput($request->input())
                ->withErrors(['key' => 'The info form already taken in this result']);
        }

        if (!Operator::isOperator($request->input('operator'))) {
            return redirect()
                ->back()
                ->with('flash_warning', 'Operator is not correct.');
        }

        ResultCondition::create([
            'result_id' => $result_id,
            'key' => $request->input('key'),
            'condition' => $request->input('condition'),
            'operator' => $request->input('operator') ?? Operator::$equal
        ]);

        return redirect()->route('admin.conditions.index', [$result_id])
            ->withFlashSuccess('Condition created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($result_id, $id)
    {
        $result = GameResult::findOrFail($result_id);
        $condition = ResultCondition::findOrFail($id);

        $params = [
            'result' => $result,
            'condition' => $condition
        ];

        return view('admin.resultConditions.show', $params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $result_id
     * @param int $id
     * @return Response
     */
    public function edit($result_id, $id)
    {
        $result = GameResult::findOrFail($result_id);
        $condition = ResultCondition::findOrFail($id);
        $forms = InfoForm::all();
        $operators = Operator::getAll();

        $params = [
            'result' => $result,
            'forms' => $forms,
            'operators' => $operators,
            'condition' => $condition
        ];

        return view('admin.resultConditions.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $result_id
     * @param int $id
     * @return void
     * @throws ValidationException
     */
    public function update(Request $request, $result_id, $id)
    {
        $condition = ResultCondition::findOrFail($id);
        $this->validate($request, [
            'key' => 'required',
            'condition' => 'required'
        ]);

        if (!Operator::isOperator($request->input('operator'))) {
            return redirect()
                ->back()
                ->with('flash_warning', 'Operator is not correct.');
        }

        $condition->key = $request->input('key');
        $condition->condition = $request->input('condition');
        $condition->operator = $request->input('operator') ?? Operator::$equal;
        $condition->save();

        return redirect()->route('admin.conditions.index', [$result_id])
            ->withFlashSuccess("The condition has successfully been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $result_id
     * @param int $id
     * @return Response
     */
    public function destroy($result_id, $id)
    {
        GameResult::findOrFail($result_id);
        $condition = ResultCondition::findOrFail($id);
        $condition->delete();
        return redirect()->route('admin.conditions.index', [$result_id])
            ->withFlashSuccess('The condition has successfully been archived.');
    }
}
