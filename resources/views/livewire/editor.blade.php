<div class="flex flex-col min-h-screen h-full overflow-hidden">
    <div class="h-10 border-b sticky top-0 bg-white z-10 flex-shrink-0">
        <div class="flex items-center justify-between h-full">
            <div></div>
            <button class="bg-indigo-600 px-3 h-full text-white">
                Save
            </button>
        </div>
    </div>

    <div class="w-full grid grid-cols-12 divide-x flex-1 h-full overflow-y-auto" x-data="blockEditor({hello2: 1})">

        <div class="col-span-9 p-6 h-full">
            <div>
                @foreach($this->blocks as $key => $data)
                <div wire:click="selectCurrentBlock('{{ $key }}')" data-id="{{ $key }}" @class(["group block
                    relative", 'outline outline-dashed'=> $key===($this->currentBlock['id'] ?? null)])>
                    {!! view($this->getBlock($data['namespace'], 'edit'))->with($data)->render(); !!}

                    <div class="invisible group-hover:visible absolute right-0 top-0">
                        <button wire:click="removeBlock('{{ $key }}')" class="text-white bg-black px-2 py-1">Remove</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="col-span-3">
            @if($this->currentBlock)

            <div class="bg-white p-6 border-b">
                {!! $this->currentBlock['namespace'] !!}

                @foreach($this->editor['blocks'][$this->currentBlock['namespace']]['attributes'] as $key => $value)
                <div>
                    <label for="{{ $key }}">{{ $key }}</label>
                    <input type="text" id="{{ $key }}" value="{{ $this->getAttribute($key) }}"
                        wire:keyup.debounce="setAttribute('{{$key}}', $event.target.value)"
                        class="w-full px-2 pr-1.5 border">
                </div>
                @endforeach
            </div>
            @endif


            <!-- ------------- -->
            <select wire:model="testBlock">
                @foreach($this->editor['blocks'] as $key => $data)
                <option value="{{ $key }}">{{ $key }}</option>
                @endforeach
            </select>

            <button wire:click="addNewBlock">
                Add
            </button>
        </div>

    </div>
</div>
