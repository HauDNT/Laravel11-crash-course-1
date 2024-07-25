<x-layout>
    <h1 class="title">{{ $user->username }}</h1>
    <p class="text my-3 text-right font-white">Total: {{$posts->total()}}</p>

    {{-- User's posts --}}
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post" />
        @endforeach
    </div>

    <div>
        {{ $posts->links() }}
    </div>
</x-layout>