<?php

namespace App\Livewire;

use App\Models\BookCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

use Image;

class ProductCategoryCreate extends Component
{
    use WithFileUploads;

    public $image;
    public $banner;
    // public $pdf;


    public $name = null;
    public $name_kh = null;
    public $link = null;
    public $order_index = 0;
    public $description = null;
    public $description_kh = null;
    public $type = 'social';
    public $link_in_product_detail = 0;

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:2048', // 2MB Max
        ]);

        session()->flash('success', 'Image successfully uploaded!');
    }
    public function updatedBanner()
    {
        $this->validate([
            'banner' => 'image|max:2048', // 2MB Max
        ]);

        session()->flash('success', 'Banner successfully uploaded!');
    }

    // public function updatedPdf()
    // {
    //     $this->validate([
    //         'pdf' => 'file|max:2048', // 2MB Max
    //     ]);

    //     session()->flash('success', 'PDF successfully uploaded!');
    // }

    // public function updated()
    // {
    //     $this->dispatch('livewire:updated');
    // }


    public function save()
    {
        $this->dispatch('livewire:updated');
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|file|max:2048',
            'banner' => 'required|file|max:2048',
            'order_index' => 'nullable',
        ]);

        // $validated['create_by_user_id'] = request()->user()->id;

        // dd($validated);

        if (!empty($this->image)) {
            // $filename = time() . '_' . $this->image->getClientOriginalName();
            $filename = time() . str()->random(10) . '.' . $this->image->getClientOriginalExtension();

            $image_path = public_path('assets/images/categories/' . $filename);
            $imageUpload = Image::make($this->image->getRealPath())->save($image_path);
            $validated['image'] = $filename;
        }
        if (!empty($this->banner)) {
            // $filename = time() . '_' . $this->image->getClientOriginalName();
            $bannerfilename = time() . str()->random(10) . '.' . $this->banner->getClientOriginalExtension();

            $image_path = public_path('assets/images/categories/' . $bannerfilename);
            $imageUpload = Image::make($this->banner->getRealPath())->save($image_path);
            $validated['banner'] = $bannerfilename;
        }

        // if (!empty($this->pdf)) {
        //     $filename = time() . '_' . $this->pdf->getClientOriginalName();
        //     $this->pdf->storeAs('publications', $filename, 'publicForPdf');
        //     $validated['pdf'] = $filename;
        // }

        $createdPublication = BookCategory::create($validated);

        // dd($createdPublication);
        return redirect('admin/product_categories')->with('success', 'Successfully Created!');

        // session()->flash('message', 'Image successfully uploaded!');
    }

    public function render()
    {
        // dd($allKeywords);
        // dump($this->selectedallKeywords);

        return view('livewire.product-category-create');
    }
}
