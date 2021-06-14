<?php

namespace App\Http\Livewire;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Livewire\Component;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search, $post, $image, $identificador;
    public $sort = 'id';
    public $direction = 'desc';
    public $listeners = ['render' => 'render'];
    public $open_edit = false;

    //CARGA APLAZADA
    public $readyToLoad = false;

    // QUANTITY FOR PAGINATION
    public $quant = '10';

    //IT SENDS THE SELECTED VARIABLE BY THE URL
    protected $queryString = [
        'quant' => ['except' => '10']
    ];

    // RULES FOR THE VALIDATION IN THE FORM
    protected $rules=[
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    public function mount(){

        $this->identificador = rand();
        $this->post = New Post();
    }


    public function render()
    {
        if ($this->readyToLoad) {
            $posts = Post::where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->quant);
        } else {
            $posts = [];
        }

        return view('livewire.show-posts', compact('posts'));
    }

    public function loadPosts(){
        $this->readyToLoad = true;
    }

    public function order($sort){

        if ($this->sort == $sort) {

            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
            
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';    
        }
        
    }

    public function edit(Post $post){
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();

        if($this->image){
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');

        }

        $this->post->save();

        $this->reset(['open_edit', 'image']);

        $this->identificador = rand();

        $this->emit('alert', 'Post succefully updated!');
    }

    public function updatingSearch(){
        $this->resetPage();
    }

}
