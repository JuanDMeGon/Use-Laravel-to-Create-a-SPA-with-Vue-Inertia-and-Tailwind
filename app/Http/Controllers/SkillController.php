<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SkillController extends Controller
{
    public function index()
    {
        return Inertia::render('Skills/All', [
            'skills' => Skill::all(),
            'availableColors' => Skill::getAvailableBackgroundColors(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique(Skill::class)
            ],
            'color' => [
                'required',
                'in:' . implode(',', Skill::getAvailableBackgroundColors())
            ],
        ]);

        Skill::create($request->all());

        return redirect()->route('skills.index');
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique(Skill::class)->ignore($skill->id)
            ],
            'color' => [
                'required',
                'in:' . implode(',', Skill::getAvailableBackgroundColors())
            ],
        ]);

        $skill->update($request->all());

        return redirect()->route('skills.index');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index');
    }
}
