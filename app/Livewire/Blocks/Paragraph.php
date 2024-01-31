<?php

namespace App\Livewire\Blocks;

use Livewire\Component;

class Paragraph extends Component
{
    public $data;

    public function render()
    {
        return view('livewire.blocks.paragraph');
    }
}
