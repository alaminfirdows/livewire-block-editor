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

    public $blocks = [];

    public function mount()
    {
        $this->editor = [
            'blocks' => [
                'hero' => [
                    'edit' => 'livewire.blocks.hero',
                    'render' => 'livewire.blocks.render.hero',
                    'data' => [
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
                    'render' => 'livewire.blocks.render.paragraph',
                    'data' => [
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
                    'render' => 'livewire.blocks.heading',
                    'data' => [
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

        $this->blocks = [
            "block-001" => [
                'namespace' => 'paragraph',
                'data' => [
                    'class' => 'text-2xl font-bold',
                    'text'  => 'Hello from paragraph block'
                ]
            ],

            // "block-002" => [
            //     'namespace' => 'heading',
            //     'attributes' => [
            //         'class' => 'text-2xl font-bold',
            //         'text'  => 'Hello from heading block'
            //     ]
            // ],

            // "block-003" => [
            //     'namespace' => 'heading',
            //     'attributes' => [
            //         'class' => 'text-2xl font-bold',
            //         'text'  => 'Hello from heading block'
            //     ]
            // ]
        ];

        $input = <<<TXT
<!-- paragraph {"text":"Hello","class":"text-base text-blue-500"} -->

<p class="text-base text-blue-500">Hello</p>

<!--/ paragraph -->

TXT;

        $this->blocks = $this->parseBlocks($input);

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

    public function updateBlock($data)
    {
        $this->blocks[$this->currentBlock['id']] = [
            'namespace' => $this->currentBlock['namespace'],
            'data' => $data
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
            ...$this->currentBlock['data'],
            $key => $value
        ]);
    }

    public function getAttribute($key)
    {
        return $this->currentBlock['data'][$key] ?? '';
    }

    // WIP
    public function addNewBlock()
    {
        $block = $this->editor['blocks'][$this->testBlock];

        $data = [];
        foreach ($block['data'] as $key => $value) {
            $data[$key] = $value['defaultValue'] ?? 'Placeholder';
        }

        $this->blocks[Str::random(10)] = [
            'namespace' => $this->testBlock,
            'data' => $data
        ];
    }
    // WIP


    public function render()
    {
        return view('livewire.editor');
    }

    public function handleSort($ids)
    {
        $newOrder = [];
        foreach ($ids as $id) {
            $blockId = $id['value'];
            $newOrder[$blockId] = $this->blocks[$blockId];
        }

        $this->blocks = $newOrder;
    }

    public function parseBlocks($input)
    {
        $matches = [];
        // Find all occurrences of the pattern in the input
        preg_match_all('/<!-- (\w+) (\{.*\}) -->/', $input, $matches, PREG_SET_ORDER);

        $parsedData = [];

        foreach ($matches as $match) {
            $namespace = $match[1];
            $data = json_decode($match[2], true);

            $parsedData[] = [
                'namespace' => $namespace,
                'data' => $data ?? []
            ];
        }

        return $parsedData;
    }

    public function handleSave()
    {
        $output = '';
        foreach ($this->blocks as $block) {
            $namespace = $block['namespace'];
            $data = $block['data'];

            $dataString = json_encode($data);

            $output .= "<!-- $namespace $dataString -->";
            $output .= "\n";
            $output .= view()->make($this->getBlock($namespace, 'render'), ['data' => $data]);
            $output .= "<!-- /$namespace -->";
            $output .= "\n";
        }

        dd($output);
        return $output;
    }
}
