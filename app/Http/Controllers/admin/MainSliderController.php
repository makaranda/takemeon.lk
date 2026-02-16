<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainSlider;
use Illuminate\Support\Facades\Storage;

class MainSliderController extends Controller
{
   // Show all main slider banners
   public function index()
   {
       //var_dump(session('success'));
       $sliders = MainSlider::where('status',1)->get();
       return view('pages.dashboard.main-slider.index', compact('sliders'));
   }

       public function create()
    {
        $sliders = MainSlider::where('status',1)->get();
        return view('pages.dashboard.main-slider.create', compact('sliders'));
    }

   // Show edit form
   public function edit($id)
   {
       $slider = MainSlider::findOrFail($id);
       return view('pages.dashboard.main-slider.edit', compact('slider'));
   }

   // Update main slider
   public function update(Request $request, $id)
   {
    //dd($request->all());
    if (!$request->isMethod('put')) {
        return back()->with('error', 'Invalid request method.');
    }

       $request->validate([
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'heading' => 'required|string|max:255',
            'description' => 'required',
            'switch_publish' => 'nullable',
       ]);

       $slider = MainSlider::findOrFail($id);
       $bannerImgPath = '';
       if ($request->hasFile('file_input')) {
            $filePath = 'public/assets/frontend/img/sliders/';
            if ($slider->banner) {
                $existingImagePath = $filePath . $slider->banner;
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Delete the old image
                }
            }
            $filePath = 'assets/frontend/img/sliders/';
            $file_input = $request->file('file_input');
            $filename = 'banner_img_' . time() . '.' . $file_input->getClientOriginalExtension();

                //dd($request->file_input);
            // Ensure the file is uploaded
            if ($file_input->move(public_path($filePath), $filename)) {
                $bannerImgPath = $filename;
            } else {
                $bannerImgPath = $slider->banner ?? 'guitar-background.jpg';
                //return redirect()->route('admin.pages')->with('error', 'Sorry, there was an error uploading your file.');
            }
        }else{
            $bannerImgPath = $slider->banner ?? 'guitar-background.jpg';
        }

        $slider->update([
            'banner' => $bannerImgPath,
            'icon' => $request->top_text ?? '',
            'heading' => $request->heading ?? '',
            'description' => $request->description ?? '',
            'switch' => $request->has('switch_publish') ? 1 : 0,
        ]);

       return redirect()->route('admin.mainslider')->with('success', 'Slider updated successfully');
       //session()->flash('success', 'Slider updated successfully');
       //return redirect()->route('admin.mainslider');
       //session()->flash('success', 'Slider updated successfully');

       //dd(session()->all());
       //return back()->with('success', 'Slider updated successfully');
   }

   // Store main slider
    public function store(Request $request)
    {
        if (!$request->isMethod('post')) {
            return back()->with('error', 'Invalid request method.');
        }

        $request->validate([
            'file_input' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'heading' => 'required|string|max:255',
            'description' => 'required',
            'switch_publish' => 'nullable',
        ]);

        $bannerImgPath = 'guitar-background.jpg'; // Default fallback

        if ($request->hasFile('file_input')) {
            $filePath = 'assets/frontend/img/sliders/';
            $file_input = $request->file('file_input');
            $filename = 'banner_img_' . time() . '.' . $file_input->getClientOriginalExtension();

            if ($file_input->move(public_path($filePath), $filename)) {
                $bannerImgPath = $filename;
            }
        }

        MainSlider::create([
            'banner' => $bannerImgPath,
            'icon' => $request->top_text ?? '',
            'heading' => $request->heading,
            'description' => $request->description,
            'switch' => $request->has('switch_publish') ? 1 : 0,
        ]);

        return redirect()->route('admin.mainslider')->with('success', 'Slider created successfully');
    }

    public function updateOrder(Request $request,$id)
    {
        //dd($request->all());
        $partner = MainSlider::findOrFail($id);
        $partner->update([
            'order' => $request->order_no_current ?? 0,
        ]);

        return redirect()->route('admin.mainslider')->with('success', 'Slider Order Number updated successfully.');
    }


   // Delete slider
   public function delete($id)
   {
       $slider = MainSlider::findOrFail($id);
       if ($slider->banner && $slider->banner !== 'main_banner.jpg') {
           Storage::delete('public/banners/' . $slider->banner);
       }
       $slider->delete();
       return redirect()->route('admin.mainslider')->with('success', 'Slider deleted successfully');
   }
}
