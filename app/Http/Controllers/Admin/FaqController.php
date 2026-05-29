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
            'question' => 'required|array|min:1',
            'question.*' => 'required|string|max:255',
            'answer' => 'required|array|min:1',
            'answer.*' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $faqRecords = [];
            foreach ($request->question as $index => $question) {
                $faqRecords[] = [
                    'question' => $question,
                    'answer' => $request->answer[$index] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if (!empty($faqRecords)) {
                Faq::insert($faqRecords);
            }

            return redirect()->route('faqs')->with('success', 'FAQ(s) created successfully.');
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
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
            ]);

            return redirect()->route('faqs')->with('success', 'FAQ updated successfully.');
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
