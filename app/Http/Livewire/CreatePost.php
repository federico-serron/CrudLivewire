<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{

    use WithFileUploads;

    public $open = false;

    public $title, $content, $image;

    protected $rules = [
        'title' => 'required|max:10',
        'content' => 'required|max:255',
        'image' => 'required|image|max:2048'
    ];

    // REAL TIME VALIDATION
    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    // VALIDATION BEFORE SAVE AND THEN SAVE
    // THE VIEW WILL BE RENDER AND use emit() & emitTo() to update the page without reload it.
    public function save(){

        $this->validate();

        $image = $this->image->store('posts');
        
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);
        $this->reset(['open', 'title', 'content', 'image']);

        $this->emitTo('show-posts','render');
        $this->emit('alert', 'Post succefully created!');
    }

    public function render()
    {

        return view('livewire.create-post');
    }
}
