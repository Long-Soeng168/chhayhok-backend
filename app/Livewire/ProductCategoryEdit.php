<?php

namespace App\Livewire;

use App\Models\BookCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

use Image;

class ProductCategoryEdit extends Component
{
    use WithFileUploads;

    public $image;

    public $banner;


    public $item; // Variable to hold the item record for editing
    public $name;
    public $name_kh;
    public $link;
    public $type = 'social';
    public $order_index;
    public $description;
    public $description_kh;
    public $link_in_product_detail;

    public function mount(BookCategory $item)
    {
        $this->item = $item; // Initialize the $item variable with the provided item model instance
        $this->name = $item->name;
        $this->order_index = $item->order_index;
    }

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

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'order_index' => 'nullable',
        ]);

        // Update the existing item record
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

        $this->item->update($validated);

        session()->flash('success', 'Link updated successfully!');

        return redirect('admin/product_categories');
    }

    public function render()
    {
        return view('livewire.product-category-create');
    }
}
