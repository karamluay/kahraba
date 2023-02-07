<?php

namespace App\Http\Livewire\Admin\Post;

use App\Models\Post;
use Livewire\Component;

class Single extends Component
{

    public $post;

    public function mount(Post $post){
        $this->post = $post;
    }

    public function delete()
    {
        $this->post->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('DeletedMessage', ['name' => __('Post') ]) ]);
        $this->emit('postDeleted');
    }

    public function render()
    {
        return view('livewire.admin.post.single')
            ->layout('admin::layouts.app');
    }
}
