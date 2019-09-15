<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Game;
use OmgGame\Models\InfoForm;
use OmgGame\Models\InfoFormType;

class InfoFormsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:info_forms');
    }

    public function index()
    {
        $forms = InfoForm::all();

        $params = [
            'infoForms' => $forms
        ];

        return view('admin.infoForms.index')->with($params);
    }

    public function create()
    {
        $types = InfoFormType::getAll();
        return view('admin.infoForms.create', ['types' => $types]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'key' => 'required|unique:info_forms',
            'description' => 'required'
        ]);

        if (!InfoFormType::isInfoFormType($request->input('type'))) {
            return redirect()
                ->back()
                ->with('flash_warning', 'Form type is not correct.');
        }

        $form = InfoForm::create([
            'type' => $request->input('type'),
            'name' => $request->input('name'),
            'key' => trim($request->input('key')),
            'value' => $request->input('value') ?? "",
            'description' => $request->input('description') ?? ""
        ]);
        return redirect()->route('admin.info_forms.index')
            ->withFlashSuccess("The form <strong>$form->name</strong> has successfully been created.");
    }

    /**
     * @param $game_id
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $form = InfoForm::find($id);
        if (!isset($form)) return redirect()->back()->with('flash_warning', 'Form not found');

        $params = [
            'infoForm' => $form
        ];
        return view('admin.infoForms.show')->with($params);
    }

    public function edit($id)
    {
        $form = InfoForm::find($id);
        if (!isset($form)) return redirect()->back()->with('flash_warning', 'Form not found');

        $types = InfoFormType::getAll();
        $params = [
            'infoForm' => $form,
            'types' => $types
        ];
        return view('admin.infoForms.edit')->with($params);
    }

    public function update(Request $request, $id)
    {
        $form = InfoForm::find($id);
        if (!isset($form)) return redirect()->back()->with('flash_warning', 'Form not found');

        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        if (!InfoFormType::isInfoFormType($request->input('type'))) {
            return redirect()
                ->back()
                ->with('flash_warning', 'Form type is not correct.');
        }

        $form->type = $request->input('type');
        $form->name = $request->input('name');
        $form->value = $request->input('value');
        $form->description = $request->input('description') ?? "";
        $form->save();

        return redirect()->route('admin.info_forms.index')
            ->withFlashSuccess("The form has successfully been updated.");
    }

    public function destroy($id)
    {
        $form = InfoForm::find($id);
        if (!isset($form)) return redirect()->back()->with('flash_warning', 'Form not found');

        $form->delete();
        return redirect()->route('admin.info_forms.index')
            ->withFlashSuccess("The form has successfully been archived.");
    }
}
