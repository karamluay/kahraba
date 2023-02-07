<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $post;

    public $name;
    public $desc;
    public $image;
    public $posttype;
    public $istop=0;
    protected $rules = [
        'name' => 'required',        
    ];

    public function mount(Post $post){
        $this->post = $post;
        $this->name = $this->post->name;
        $this->desc = $this->post->desc;
        $this->image = $this->post->image;        
        $this->istop = $this->post->istop;        
        $this->posttype = $this->post->posttype;        
    }

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('UpdatedMessage', ['name' => __('Post') ]) ]);
        
        if($this->getPropertyValue('image') and is_object($this->image)) {
            $this->image = $this->getPropertyValue('image')->store('images/articles','public');
        }

  
        $this->post->update([
            'name' => $this->name,
            'desc' => $this->desc,
            'image' => $this->image,   
            'posttype' => $this->posttype,   
            'istop' => $this->istop,           
        ]);
    }

    public function render()
    {
        return view('livewire.admin.post.update', [
            'post' => $this->post
        ])->layout('admin::layouts.app', ['title' => __('UpdateTitle', ['name' => __('Post') ])]);
    }
}
