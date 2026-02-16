<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first(); // Assuming there's only one settings row
        return view('pages.dashboard.settings.edit', compact('setting'));
    }

    // Update settings
    public function update(Request $request)
    {
        if (!$request->isMethod('put')) {
            return back()->with('error', 'Invalid request method.');
        }
        //dd($request);
        $request->validate([
            'website_name' => 'nullable|string|max:255',
            'website_title' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'email_address' => 'required|string|email|max:255',
            'address' => 'required|string',
            'google_map' => 'required|string',
            'footer_content' => 'required|string',
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file_input2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $setting = Setting::first(); // Assuming only one settings record exists
        if (!$setting) {
            $setting = new Setting();
        }

        // $uploadPath = public_path('assets/uploads/images/'); // Define custom upload path

        // if (!file_exists($uploadPath)) {
        //     mkdir($uploadPath, 0777, true); // Create the directory if it doesn't exist
        // }


        if ($request->hasFile('file_input')) {
            $filePath = 'public/assets/frontend/img/';
            if ($setting->main_logo) {
                $existingImagePath = $filePath . $setting->main_logo;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/frontend/img/';
            $file_input = $request->file('file_input');
            $filename = 'main_logo_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $mainLogoPath = $filename;
            } else {
                $mainLogoPath = $setting->main_logo ?? 'king-viking-logo-defoult.jpg';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $mainLogoPath = $setting->main_logo ?? 'king-viking-logo-defoult.jpg';
        }


        if ($request->hasFile('file_input2')) {
            $filePath = 'public/assets/frontend/img/';
            if ($setting->fevicon_logo) {
                $existingImagePath = $filePath . $setting->fevicon_logo;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/frontend/img/';
            $file_input = $request->file('file_input2');
            $filename = 'fevicon_logo_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $faviconLogo = $filename;
            } else {
                $faviconLogo = $setting->fevicon_logo ?? 'fevicon_king-viking-logo-defoult.jpg';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $faviconLogo = $setting->fevicon_logo ?? 'fevicon_king-viking-logo-defoult.jpg';
        }


        if ($request->hasFile('file_input3')) {
            $filePath = 'public/assets/frontend/img/banner/';
            if ($setting->page_banner) {
                $existingImagePath = $filePath . $setting->page_banner;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/frontend/img/banner/';
            $file_input = $request->file('file_input3');
            $filename = 'page_banner_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $pageBannerPath = $filename;
            } else {
                $pageBannerPath = $setting->page_banner ?? 'page-bg-area-img.jpg';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $pageBannerPath = $setting->page_banner ?? 'page-bg-area-img.jpg';
        }


        if ($request->hasFile('file_input4')) {
            $filePath = 'public/assets/frontend/img/';
            if ($setting->footer_logo) {
                $existingImagePath = $filePath . $setting->footer_logo;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/frontend/img/';
            $file_input = $request->file('file_input4');
            $filename = 'footer_logo_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $footerLogoPath = $filename;
            } else {
                $footerLogoPath = $setting->footer_logo ?? 'iwgc-footer-logo-new.png';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $footerLogoPath = $setting->footer_logo ?? 'iwgc-footer-logo-new.png';
        }

        $mainLogo = $setting->main_logo ?? '';
        $feviconLogo = $setting->fevicon_logo ?? '';
        $footerLogo = $setting->footer_logo ?? '';
        $pageBanner = $setting->page_banner ?? '';

        $setting->update([
            'website_name' => $request->website_name ?? '',
            'website_title' => $request->website_title ?? '',
            'main_logo' => $mainLogoPath ?? $mainLogo,
            'footer_logo' => $footerLogoPath ?? $footerLogo,
            'page_banner' => $pageBannerPath ?? $pageBanner,
            'fevicon_logo' => $faviconLogo ?? $feviconLogo,
            'contact_number' => $request->contact_number ?? '',
            'email_address' => $request->email_address ?? '',
            'address' => $request->address ?? '',
            'google_map' => $request->google_map ?? '',
            'social_facebook' => $request->social_facebook ?? '',
            'social_linkedin' => $request->social_linkedin ?? '',
            'social_youtube' => $request->social_youtube ?? '',
            'social_instagram' => $request->social_instagram ?? '',
            'special_offer' => $request->special_offer ?? '',
            'footer_content' => $request->footer_content ?? '',
            'seo_keywords' => $request->seo_keywords ?? '',
            'seo_description' => $request->seo_description ?? '',
            'status' => $request->has('switch_publish') && $request->switch_publish == 'on' ? 1 : 0,
        ]);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully');
    }

}
