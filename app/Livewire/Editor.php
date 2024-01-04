<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class Editor extends Component
{
    // WIP
    public $testBlock = 'hero';
    // WIP

    public array $editor = [];

    public $currentBlock = '';

    public $blocks = [
        "block-001" => [
            'namespace' => 'hero',
            'attributes' => [
                'heading_1'  => 'heading text',
                'description'  => 'description',
                'words'  => 'Hello,Chatbot'
            ]
        ],

        "block-002" => [
            'namespace' => 'heading',
            'attributes' => [
                'class' => 'text-2xl font-bold',
                'text'  => 'Hello from heading block'
            ]
        ]
    ];

    public function mount()
    {
        $this->editor = [
            'blocks' => [
                'hero' => [
                    'edit' => 'livewire.blocks.hero',
                    'render' => '',
                    'attributes' => [
                        'heading_1' => [
                            "type" => 'text',
                            'defaultValue' => 'Hello',
                        ],
                        'description' => [
                            "type" => 'text',
                            'defaultValue' => 'Hello',
                        ],
                        'words' => [
                            "type" => 'text',
                            'defaultValue' => 'Hello',
                        ],
                    ]
                ],
                'paragraph' => [
                    'edit' => 'livewire.blocks.paragraph',
                    'render' => '',
                    'attributes' => [
                        'text' => [
                            "type" => 'text',
                            'defaultValue' => 'Hello',
                        ],
                        'class' => [
                            "type" => 'text',
                            'defaultValue' => 'text-base text-red-500',
                        ],
                    ]
                ],
                'heading' => [
                    'edit' => 'livewire.blocks.heading',
                    'render' => '',
                    'attributes' => [
                        'text' => [
                            "type" => 'text',
                            'defaultValue' => 'Hello',
                        ],
                        'class' => [
                            "type" => 'text',
                            'defaultValue' => 'text-2xl font-bold',
                        ],
                    ]
                ]
            ],
        ];

        $this->selectCurrentBlock('block-001');
    }

    public function selectCurrentBlock(?string $blockId)
    {
        if (!$blockId || !isset($this->blocks[$blockId])) {
            $this->currentBlock = '';
            return;
        }

        $this->currentBlock = [
            'id' => $blockId,
            ...$this->blocks[$blockId]
        ];
    }

    private function getBlock($block, $type = 'edit')
    {
        return $this->editor['blocks'][$block][$type] ?? '';
    }

    public function updateBlock($attributes)
    {
        $this->blocks[$this->currentBlock['id']] = [
            'namespace' => $this->currentBlock['namespace'],
            'attributes' => $attributes
        ];
    }

    // remove block
    public function removeBlock($blockId)
    {
        unset($this->blocks[$blockId]);
    }

    public function setAttribute($key, $value)
    {
        $this->updateBlock([
            ...$this->currentBlock['attributes'],
            $key => $value
        ]);
    }

    public function getAttribute($key)
    {
        return $this->currentBlock['attributes'][$key] ?? '';
    }

    // WIP
    public function addNewBlock()
    {
        $block = $this->editor['blocks'][$this->testBlock];

        $attributes = [];
        foreach ($block['attributes'] as $key => $value) {
            $attributes[$key] = $value['defaultValue'] ?? 'Placeholder';
        }

        $this->blocks[Str::random(10)] = [
            'namespace' => $this->testBlock,
            'attributes' => $attributes
        ];
    }
    // WIP


    public function render()
    {
        return view('livewire.editor');
    }
}
