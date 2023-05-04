<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿詳細
        </h2>
        <x-validation-errors class="mb-4" :errors="$errors" />
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <div class="px-2 mt-4">
                <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                    <h1 class="text-lg text-gray-700 font-semibold">
                        {{ $post->title }}
                    </h1>
                        <hr class="w-full">
                    </div>

                    @if (Auth::user()->id == $post->user->id)
                        <div class="flex justify-end mt-4">
                            <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-green-700 float-right">編集</x-primary-button></a>
                            <form method="post" action="{{route('post.destroy', $post)}}">
                            @csrf
                            @method('delete')
                                <x-primary-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                            </form>
                        </div>
                    @endif
                        <p class="mt-4 py-4 whitespace-pre-line">￥{{number_format($post->money)}} → 実質無料</p>
                        <p class="mt-4 text-gray-600 whitespace-pre-line">{{$post->body}}</p>
                        <div class="mt-4">
                            @if($post->image)
                                @if (App::environment('local'))
                                    <img src="/{{ $image }}" class="mx-auto object-contain" style="height:300px;">
                                @else
                                    <img src="https://phpwastecrud.s3.ap-northeast-3.amazonaws.com/{{$image}}" class="mx-auto object-contain" style="height:300px;">
                                @endif
                            @endif
                        </div>
                        <div class="my-3">
                            @if (!$post->isNicedBy(Auth::user()))
                                <span class="nices">
                                    <i class="fas fa-thumbs-up mt-3 nice-toggle" data-post-id="{{ $post->id }}"></i>
                                    <span class="nice-counter">{{$post->nices->count()}}</span>
                                </span>
                            @else
                            <span class="nices">
                                <i class="fas fa-thumbs-up heart mt-3 nice-toggle niced" data-post-id="{{ $post->id }}"></i>
                                <span class="nice-counter">{{$post->nices->count()}}</span>
                            </span>
                            @endif
                        </div>
                        <div class="text-sm font-semibold flex flex-row-reverse">
                            <p> {{ $post->user->name }} • {{$post->created_at->format('Y年m月d日')}}</p>
                        </div>
                    </div>
                </div>

                @foreach ($post->comments as $comment)
                <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg mt-8 whitespace-pre-line">
                    {{$comment->body}}
                    <div class="text-sm font-semibold flex flex-row-reverse">
                        <p> {{ $comment->user->name }} • {{$comment->created_at->diffForHumans()}}</p>
                    </div>
                </div>
                @endforeach

                <div class="mt-4 mb-12">
                    <form method="post" action="{{route('comment.store')}}">
                        @csrf
                        <input type="hidden" name='post_id' value="{{$post->id}}">
                        <textarea name="body" class="w-full rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{old('body')}}</textarea>
                        <x-primary-button class="float-right mr-4 mb-12">コメントする</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
