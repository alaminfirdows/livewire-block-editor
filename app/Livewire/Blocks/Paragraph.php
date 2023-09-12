<?php

namespace App\Livewire\Blocks;

use Livewire\Component;

class Paragraph extends Component
{
    public $text = 'Hello World.';

    public function render()
    {
        return view('livewire.blocks.paragraph');
    }

    public function edit()
    {
        return view('livewire.blocks.paragraph');
    }

    public function save()
    {
        return [
            'type' => 'paragraph',
            'data' => [
                'text' => $this->text,
            ],
        ];
    }
}
