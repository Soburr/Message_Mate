<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {

    public function delete($noteId) {
        $note = Note::where('id', $noteId)->first();
        $note->delete();
    }

    public function with() {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
    @if ($notes->isEmpty())
      <div class="text-center">
        <p class="text-xl font-bold">No notes yet!</p>
        <p class="text-sm">Let's create your first note!</p>
        <x-button primary icon-right="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>Create Note</x-button>
      </div>
    @else
        <x-button primary icon-right="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate class="mb-12">Create Note</x-button>

      <div class="grid grid-cols-3 gap-4">
        @foreach ($notes as $note)
           <x-card wire:key='{{ $note->id }}'>
               <div class="flex justify-between">
                  <div>
                    <a href="#" class="text-xl font-bold hover:underline hover:text-blue-500">{{ $note->title }}</a>
                    <p class="text-xs mt-2">{{ Str::limit($note->body, 50) }}</p>
                  </div>
                  <div class="text-xs-gray-500">
                    {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-y') }}
                  </div>
               </div>

               <div class="flex items-end justify-between mt-4 space-x-1">
                  <p class="text-xs">Recipient: <span class="font-semibold"> {{ $note->recipient }} </span> </p>

                  <div style="display: flex; gap: 10px;">
                    <x-button icon="eye"></x-button>
                    <x-button wire:click="delete('{{ $note->id }}')" icon="trash"></x-button>
                  </div>

               </div>
           </x-card>
         @endforeach
        </div>
    @endif
    </div>
</div>
