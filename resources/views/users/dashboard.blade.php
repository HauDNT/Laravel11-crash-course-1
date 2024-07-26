<x-layout>
    <h1 class="title">Welcome {{ auth()->user()->username }}, you have {{ $posts->total() }} posts</h1>

    {{-- Create post form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>

        {{-- Session messages --}}
        @if (session("success"))
            <div class="mb-2">
                <x-flashMsg msg="{{session('success')}}" bg="bg-green-500"/>
            </div>
        @elseif (session("delete")) 
            <div class="mb-2">
                <x-flashMsg msg="{{session('delete')}}" bg="bg-red-500"/>
            </div>
        @endif

        <form action="{{ route("posts.store") }}" method="POST">
            @csrf

            {{-- Post title --}}
            <div class="mb-4">
                <label for="title">Post title</label>
                <input type="text" name="title" value="{{ old("title") }}" class="input
                @error("title") ring-offset-2 ring-red-500 @enderror">
                @error("title")
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post body --}}
            <div class="mb-4">
                <label for="body">Post content</label>
                <textarea name="body" rows="5" class="input
                @error("body") ring-offset-2 ring-red-500 @enderror">
                    {{ old("body") }}

                    @error("body")
                        <p class="error">{{ $message }}</p>
                    @enderror
                </textarea>            
            </div>

            <button class="btn">Create</button>
        </form>
    </div>

    {{-- User list posts --}}
    <h2 class="title mt-10">Your Latest Posts</h2>
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            {{-- <x-postCard post="{{ $post }}" /> --}} 
            {{-- Biến post là 1 object nên không thể truyền như kiểu trên mà phải truyền như bên dưới --}}
            <x-postCard :post="$post">
                <div class="flex">
                    {{-- Update post --}}
                    <a href="{{ route('posts.edit', $post) }}" class="flex items-center mr-3 justify-center px-3 h-9 rounded-md leading-loose bg-blue-400 text-white">
                        Update
                    </a>
    
                    {{-- Delete form --}}
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        {{-- Fake method --}}
                        <button class="flex items-center justify-center px-3 h-9 rounded-md leading-loose bg-red-400 text-white">
                            Delete
                        </button>
                    </form>
                </div>
            </x-postCard>
        @endforeach
    </div>

    <div>
        {{ $posts -> links() }}
    </div>


</x-layout>