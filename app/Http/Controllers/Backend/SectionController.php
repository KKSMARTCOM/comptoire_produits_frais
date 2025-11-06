<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::paginate(10);

        return view('backend.pages.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.section.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        try {
            Section::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return back()->withSuccess('Nouvelle section ajoutée avec succès');
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $section = Section::where('id', $id)->first();
            return view('backend.pages.section.edit', compact('section'));
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $section = Section::where('id', $id)->firstOrFail();

            $section->update([
                'name' => $request->name,
                'description' => $request->description ?? $section->description
            ]);

            return redirect()->route('panel.section.index');
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $section = Section::where('id', $request->id)->firstOrFail();

            $section->delete();
            return response(['error' => false, 'message' => 'Section supprimée avec succès !']);
        } catch (\Exception $e) {
            dd($e);
            //throw $th;
        }
    }
}
