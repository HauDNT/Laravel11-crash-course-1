@props(['post', 'full' => false])

<div class="card relative pb-12">
    {{-- Image --}}
    <div>
        @if ($post->image)
            <img src="{{ asset("storage/" . $post->image) }}" alt="" class="rounded max-h-50">
        @else
            <img src="{{ asset("storage/posts_images/default.png") }}" alt="" class="rounded">
        @endif
    </div>

    {{-- Title --}}
    <h2 class="font-bold text-xl">
        {{ $post->title }}
    </h2>

    {{-- Author and Date --}}
    <div class="text-xs font-light mb-4">
        <span>Posted {{ $post->created_at->diffForHumans() }} by </span>
        <a href="{{ route("posts.user", $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>
    </div>

    {{-- Body --}}
    @if ($full)
        <div class="text-sm">
            <p class="mb-2">{{ $post->body }}</p>
        </div>
    @else
        <div class="text-sm">
            <p class="mb-2">{{ Str::words($post->body, 30) }}</p>
            <a href="{{ route('posts.show', $post) }}" class="text-blue-600">Read more &rarr;</a>
        </div>
    @endif

    <div class="absolute bottom-3 right-6">
        {{ $slot }}
    </div>

    {{-- Footer --}}
    <div class="post-footer absolute left-6 bottom-3">
        <p>{{ $post->created_at }}</p>
    </div>
</div>