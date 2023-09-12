<div>
    @foreach([1,2,3] as $id)
    @livewire('blocks.paragraph', ['text' => 'Hello World! - ' . $id])
    @endforeach
</div>
