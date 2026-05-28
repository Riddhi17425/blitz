<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'faq_title' => 'required|array|min:1',
            'faq_title.*' => 'required|string|max:255',
            'faq_description' => 'required|array|min:1',
            'faq_description.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $items = [];
            foreach ($request->faq_title as $index => $title) {
                $items[] = [
                    'title' => $title,
                    'description' => $request->faq_description[$index] ?? '',
                ];
            }

            Faq::create([
                'faq_items' => $items,
            ]);

            return redirect()->route('faqs')->with('success', 'FAQ group created successfully.');
        } catch (\Exception $e) {
            Log::error('Faq store failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to save FAQ: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'faq_title' => 'required|array|min:1',
            'faq_title.*' => 'required|string|max:255',
            'faq_description' => 'required|array|min:1',
            'faq_description.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $items = [];
            foreach ($request->faq_title as $index => $title) {
                $items[] = [
                    'title' => $title,
                    'description' => $request->faq_description[$index] ?? '',
                ];
            }

            $faq->update(['faq_items' => $items]);

            return redirect()->route('faqs')->with('success', 'FAQ group updated successfully.');
        } catch (\Exception $e) {
            Log::error('Faq update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update FAQ: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);

        try {
            $faq->delete();
            return redirect()->route('faqs')->with('success', 'FAQ group deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Faq delete failed: ' . $e->getMessage());
            return redirect()->route('faqs')->with('error', 'Failed to delete FAQ.');
        }
    }
}
