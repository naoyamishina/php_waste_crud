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
                    <div class="text-sm font-semibold flex flex-row-reverse">
                        <a href="{{route('post.show', $post)}}" style="color:white;">
                            <span class="badge float-right ml-2">
                                コメント {{$post->comments->count()}}件
                            </span>
                        </a>
                        @if($post->image)
                            <a href="{{route('post.show', $post)}}" style="color:white;">
                                <span class="badge float-right">
                                    写真あり
                                </span>
                            </a>
                        @endif
                    </div>
                    <div>
                        @if (!Auth::user()->is_nice($post->id))
                            <x-primary-button class="bg-gray-700 mt-2" onclick="nice({{$post->id}})">いいね {{$post->nices->count()}}</x-primary-button>
                        @else
                            <x-primary-button class="bg-red-700 mt-2" onclick="unnice({{$post->id}})">いいね解除 {{$post->nices->count()}}</x-primary-button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>

