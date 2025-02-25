<?php

namespace App\Livewire\User\Profile;

use Livewire\Component;

class Posts extends Component
{

    public $posts;
    public $editingPostId = null;
    public $editTitle;
    public $editTribute;

    public function render()
    {
        $this->posts = auth()->user()->tributes()->latest()->get();
        return view('livewire.user.profile.posts');
    }

    public function deletePost($post_id)
    {
        $post = auth()->user()->tributes()->find($post_id);
        if ($post) {
            $post->delete();
            $this->posts = auth()->user()->tributes()->latest()->get();
        }
    }

    public function startEditing($postId)
    {
        $post = auth()->user()->tributes()->find($postId);
        if ($post) {
            $this->editingPostId = $postId;
            $this->editTitle = $post->title;
            $this->editTribute = $post->tribute;
        }
    }

    // Update the post with new data
    public function updatePost($postId)
    {
        $post = auth()->user()->tributes()->find($postId);
        if ($post) {
            $post->update([
                'title' => $this->editTitle,
                'tribute' => $this->editTribute,
            ]);
            $this->editingPostId = null;
            $this->posts = auth()->user()->tributes()->latest()->get();
        }
    }

    // Cancel editing mode
    public function cancelEditing()
    {
        $this->editingPostId = null;
    }

}
