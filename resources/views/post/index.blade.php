<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿一覧
        </h2>
        <x-message :message="session('message')" />
        <a href="{{route('post.create')}}"><button class="font-semibold text-lg text-white leading-tight bg-green-700 p-4 rounded-md my-4">新規作成</button></a>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('post.index') }}">
            <div class="md:flex items-center mt-8">
                <div class="flex">
                    <input type="search" class="w-auto py-2 placeholder-gray-400 border border-gray-300 rounded-md" placeholder="最小金額を入力" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
                    <button class="bg-gray-300 mx-4 p-2 rounded-md" type="submit">検索</button>
                    <button class="bg-gray-300 p-2 rounded-md">
                        <a href="{{ route('post.index') }}" class="">
                            クリア
                        </a>
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    {{-- 投稿一覧表示用のコード --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (count($posts) == 0)
                <p class="mt-4">
                まだ投稿はありません。
                </p>
        @else
        @foreach ($posts as $post)
            <a href="{{route('post.show', $post)}}">
                <div class="mx-4 sm:p-8">
                    <div class="mt-4">
                        <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                            <div class="mt-4">
                                <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer float-left">
                                    {{ $post->title }}
                                </h1>
                                <hr class="w-full">
                                <p class="mt-4 py-4 whitespace-pre-line">￥{{number_format($post->money)}} → 実質無料</p>
                                <p class="mt-2 whitespace-pre-line">{{Str::limit($post->body, 100, '...')}} </p>
                                @if (Auth::user()->id == $post->user->id)
                                    <div class="flex justify-end mt-1 mb-3">
                                        <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-green-700 float-right">編集</x-primary-button></a>
                                        <form method="post" action="{{route('post.destroy', $post)}}">
                                        @csrf
                                        @method('delete')
                                            <x-primary-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                                        </form>
                                    </div>
                                @endif
                                <div class="text-sm font-semibold flex flex-row-reverse">
                                    <p>{{ $post->user->name }} • {{$post->created_at->format('Y年m月d日')}}</p>
                                </div>
                                <hr class="w-full mb-2">
                                <a href="{{route('post.show', $post)}}" style="color:white;">
                                    <span class="badge">
                                        コメント {{$post->comments->count()}}件
                                    </span>
                                </a> 
                                <div>
                                    @if (!Auth::user()->is_nice($post->id))
                                    <form action="{{ route('nice.store', $post) }}" method="post">
                                        @csrf
                                        <x-primary-button class="bg-gray-700 mt-2">いいね {{$post->nices->count()}}</x-primary-button>
                                    </form>
                                    @else
                                    <form action="{{ route('nice.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <x-primary-button class="bg-red-700 mt-2">いいね解除 {{$post->nices->count()}}</x-primary-button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        <div class="mt-6 mb-4 items-center">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
