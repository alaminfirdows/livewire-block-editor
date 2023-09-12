<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="flex w-full h-screen max-w-7xl mx-auto">
    <div class="flex-1 bg-gray-50">
        {!! $content !!}
    </div>

    <div class="border-l w-96 bg-gray-100">
        @foreach($blocks as $block)
        @livewire($block['namespace'], ['block' => $block], key($block['namespace']))
        @endforeach
    </div>
</div>
