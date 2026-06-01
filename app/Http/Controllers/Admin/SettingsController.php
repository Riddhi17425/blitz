<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'head_office_address' => 'nullable|string',
            'certifications.*' => 'nullable',
            'certifications_name.*' => 'nullable|string|max:255',
            'certifications_file.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'client_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'remove_certification' => 'array',
            'remove_certification.*' => 'nullable|string',
            'remove_client_image' => 'array',
            'remove_client_image.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $settings = Setting::first();
            if (!$settings) {
                $settings = new Setting();
            }

                $existingCertifications = $settings->certifications ?? [];
                // Normalize existing certifications to array of objects ['name'=>..., 'file'=>...]
                $normalizedCertifications = [];
                foreach ($existingCertifications as $cert) {
                    if (is_array($cert) && isset($cert['file'])) {
                        $normalizedCertifications[] = $cert;
                    } elseif (is_string($cert)) {
                        $normalizedCertifications[] = ['name' => '', 'file' => $cert];
                    }
                }
            $existingClientImages = $settings->client_images ?? [];
            $removeCertifications = (array) $request->input('remove_certification', []);
            $removeClientImages = (array) $request->input('remove_client_image', []);

            // removeCertifications contains file names to remove
            $certifications = [];
            foreach ($normalizedCertifications as $cert) {
                if (!in_array($cert['file'], $removeCertifications)) {
                    $certifications[] = $cert;
                }
            }
            $clientImages = array_values(array_diff($existingClientImages, $removeClientImages));

            // Handle new certification uploads along with names
            $certNames = (array) $request->input('certifications_name', []);
            $certFiles = $request->file('certifications_file', []);
            foreach ($certFiles as $index => $file) {
                if ($file && $file->isValid()) {
                    $filename = storeImageWithTimeId($file, 'images/settings_certifications');
                    $certifications[] = [
                        'name' => $certNames[$index] ?? '',
                        'file' => $filename,
                    ];
                }
            }

            foreach ($removeCertifications as $filename) {
                if ($filename && File::exists(public_path('images/settings_certifications/' . $filename))) {
                    File::delete(public_path('images/settings_certifications/' . $filename));
                }
            }

            foreach ($request->file('client_images', []) as $file) {
                if ($file && $file->isValid()) {
                    $clientImages[] = storeImageWithTimeId($file, 'images/settings_clients');
                }
            }

            foreach ($removeClientImages as $filename) {
                if ($filename && File::exists(public_path('images/settings_clients/' . $filename))) {
                    File::delete(public_path('images/settings_clients/' . $filename));
                }
            }

            $settings->phone = $request->input('phone');
            $settings->email = $request->input('email');
            $settings->head_office_address = $request->input('head_office_address');
            $settings->certifications = $certifications;
            $settings->client_images = $clientImages;
            $settings->save();

            return redirect()->route('settings')->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            Log::error('Settings update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to save settings: ' . $e->getMessage());
        }
    }
}
