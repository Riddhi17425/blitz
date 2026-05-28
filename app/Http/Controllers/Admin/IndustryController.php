<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::orderBy('created_at', 'desc')->get();
        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $imageName = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = storeImageWithTimeId($request->file('image'), 'images/industries');
            }

            Industry::create([
                'title' => $request->title,
                'image' => $imageName,
            ]);

            return redirect()->route('industries')->with('success', 'Industry created successfully.');
        } catch (\Exception $e) {
            Log::error('Industry store failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to save industry: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $industry = Industry::findOrFail($id);
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, $id)
    {
        $industry = Industry::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $imageName = $industry->image;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($industry->image && File::exists(public_path('images/industries/' . $industry->image))) {
                    File::delete(public_path('images/industries/' . $industry->image));
                }
                $imageName = storeImageWithTimeId($request->file('image'), 'images/industries');
            }

            $industry->update([
                'title' => $request->title,
                'image' => $imageName,
            ]);

            return redirect()->route('industries')->with('success', 'Industry updated successfully.');
        } catch (\Exception $e) {
            Log::error('Industry update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update industry: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $industry = Industry::findOrFail($id);
        try {
            if ($industry->image && File::exists(public_path('images/industries/' . $industry->image))) {
                File::delete(public_path('images/industries/' . $industry->image));
            }
            $industry->delete();

            return redirect()->route('industries')->with('success', 'Industry deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Industry delete failed: ' . $e->getMessage());
            return redirect()->route('industries')->with('error', 'Failed to delete industry.');
        }
    }
}
