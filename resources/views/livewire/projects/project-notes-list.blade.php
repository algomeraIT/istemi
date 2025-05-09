{{-- resources/views/livewire/projects/project-notes-list.blade.php --}}
@foreach($notes as $month => $monthNotes)
  <div class="flex items-center my-4">
    <span class="bg-gray-100 text-cyan-500 px-3 py-1 font-semibold">{{ $month }}</span>
    <div class="h-px bg-gray-300 flex-1 ml-2"></div>
  </div>

  @foreach($monthNotes as $note)
    <div class="border p-4 mb-4 rounded">
      <div class="flex items-center space-x-2">
        <flux:icon.user class="text-cyan-400" />
        <span class="font-medium">{{ $note->user_name }}</span>
        <span class="text-gray-500">({{ $note->role }})</span>
        <span class="text-xs text-gray-400 ml-auto">{{ $note->created_at->diffForHumans() }}</span>
      </div>
      <p class="mt-2 text-gray-700">{{ $note->note }}</p>
    </div>
  @endforeach
@endforeach