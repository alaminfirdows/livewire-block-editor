<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function view()
    {

        $blocks = [
            [
                'namespace' => 'blocks.paragraph',
                'data' => [
                    'text' => 'Hello World',
                ]
            ],
            [
                'namespace' => 'blocks.button',
                'data' => [
                    'text' => 'Hello World',
                ]
            ],
        ];

        $patterns = [
            [
                'namespace' => 'patterns.posts',
                'data' => [
                    'text' => 'Hello World',
                ],
            ],
        ];

        $content = view('content')->render();

        $has_match = preg_match(
            '/<!--\s+(?P<closer>\/)?e:(?P<namespace>[a-z][a-z0-9_-]*\/)?(?P<name>[a-z][a-z0-9_-]*)\s+(?P<attrs>{(?:(?:[^}]+|}+(?=})|(?!}\s+\/?-->).)*+)?}\s+)?(?P<void>\/)?-->/s',
            $content,
            $matches,
            PREG_OFFSET_CAPTURE,
        );

        // dd($matches['name']);

        return view('editor', [
            'content' => $content,
            'blocks' => $blocks,
            'patterns' => $patterns,
        ]);
    }
}
