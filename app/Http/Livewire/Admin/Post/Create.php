<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $desc;
    public $images;
    public $posttype;
    public $istop=0;
    
    protected $rules = [
        'name' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Post') ])]);
        
        if($this->images) {
          
            $images = array();
            foreach ($this->images as $item) {
                    $images[] = $item->store("images","public");
                    
            }
          
           
           
          
        }
        Post::create([
            'name' => $this->name,
            'desc' => $this->desc,
            'image' => json_encode($images),            
            'posttype' => $this->posttype,   
            'istop' => $this->istop,   
                     
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.post.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Post') ])]);
    }
}
