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
    }

    public function index($game_id)
    {
        $form = InfoForm::where('game_id', $game_id)->paginate();
        $game = Game::findOrFail($game_id);

        $params = [
            'infoForms' => $form,
            'game' => $game
        ];

        return view('admin.infoForms.index')->with($params);
    }

    public function create($game_id)
    {
        $game = Game::find($game_id);
        if (!isset($game)) return redirect()->back()->with('flash_warning', 'Game not found');

        $types = InfoFormType::getAll();
        return view('admin.infoForms.create', ['game' => $game, 'types' => $types]);
    }

    // TODO Fix database InfoForm key & ExtraInfo key is unique.
    // TODO Add table user_game_user to save relationship between user and game user (many to many)
    public function store(Request $request, $game_id)
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
            'game_id' => $game_id,
            'type' => $request->input('type'),
            'name' => $request->input('name'),
            'key' => trim($request->input('key')),
            'value' => $request->input('value'),
            'description' => $request->input('description') ?? ""
        ]);
        return redirect()->route('admin.infoForms.index', [$game_id])
            ->withFlashSuccess("The form <strong>$form->name</strong> has successfully been created.");
    }

    /**
     * @param $game_id
     * @param $id
     * @return Response
     */
    public function show($game_id, $id)
    {
        $game = Game::find($game_id);
        if (!isset($game)) return redirect()->back()->with('flash_warning', 'Game not found');
        $form = InfoForm::find($id);
        if (!isset($form)) return redirect()->back()->with('flash_warning', 'Form not found');

        $params = [
            'infoForm' => $form,
            'game' => $game
        ];
        return view('admin.infoForms.show')->with($params);
    }

    public function edit($game_id, $id)
    {
        $game = Game::find($game_id);
        if (!isset($game)) return redirect()->back()->with('flash_warning', 'Game not found');
        $form = InfoForm::find($id);
        if (!isset($form)) return redirect()->back()->with('flash_warning', 'Form not found');

        $types = InfoFormType::getAll();
        $params = [
            'infoForm' => $form,
            'game' => $game,
            'types' => $types
        ];
        return view('admin.infoForms.edit')->with($params);
    }

    public function update(Request $request, $game_id, $id)
    {
        $game = Game::find($game_id);
        if (!isset($game)) return redirect()->back()->with('flash_warning', 'Game not found');
        $form = InfoForm::find($id);
        if (!isset($form)) return redirect()->back()->with('flash_warning', 'Form not found');

        $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'description' => 'required',
            'key' => 'required|unique:info_forms,key, ' . $id,
        ]);

        if (!InfoFormType::isInfoFormType($request->input('type'))) {
            return redirect()
                ->back()
                ->with('flash_warning', 'Form type is not correct.');
        }

        $form->type = $request->input('type');
        $form->name = $request->input('name');
        $form->key = trim($request->input('key'));
        $form->value = $request->input('value');
        $form->description = $request->input('description') ?? "";
        $form->save();

        return redirect()->route('admin.infoForms.index', [$game_id])
            ->withFlashSuccess("The form has successfully been updated.");
    }

    public function destroy($game_id, $id)
    {
        $form = InfoForm::find($id);
        if (!isset($form)) return redirect()->back()->with('flash_warning', 'Form not found');

        $form->delete();
        return redirect()->route('admin.infoForms.index', [$game_id])
            ->withFlashSuccess("The form has successfully been archived.");
    }
}
