<?php


namespace App\Http\Controllers;


use App\Team;
use Illuminate\Http\Request;
use App\Helpers\FileManager;

class TeamsController extends Controller
{

    public function index()
    {
        $teams = Team::all();

        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10048'
        ]);
        $data = $request->input();

        $image = $request->file('photo');
            if ($image) {
                if ($fileUploaded = (new FileManager())->upload($image, 'teams')) {
                    $data['photo'] = $fileUploaded;

                } else {
                    session()->flash('error', 'Photo could not be uploaded');
                }
            }
        $team = Team::create($data);
            if ($team) {
                flash()->success('Team member was successfully added.');
            } else {
                flash()->error('Team member could not be added.');
            }
        return back();
    }


    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10048'
        ]);

        $team->fill($request->input());
        $image = $request->file('photo');
        if ($image) {
            if ($fileUploaded = (new FileManager())->update($image, $team->photo,'teams')) {
                $team->fill(['photo' => $fileUploaded]);
            } else {
                session()->flash('error', 'Photo could not be uploaded');
            }
        }
        if ($team->update()) {
            flash()->success('Team member was successfully updated!');
        } else {
            flash()->error('Team member could not be updated');
        }
        return back();
    }


    public function destroy(Team $team)
    {
        if ($team->delete())
        {
            (new FileManager)->delete($team->photo, 'teams');
            flash()->success('Team member was successfully deleted!');
        } else {
            flash()->error('Team member could not be deleted');
        }
        return back();
    }

}
