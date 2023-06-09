<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の新規作成
        </h2>
        <x-validation-errors class="mb-4" :errors="$errors" />

        @if(session('message'))
            <x-message :message="session('message')" />
        @endif
    </x-slot>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mx-4 sm:p-8">
                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="md:flex items-center mt-8">
                        <div class="w-full flex flex-col">
                        <label for="title" class="font-semibold leading-none mt-4 mb-3">タイトル</label>
                        <input type="text" name="title" class="w-auto py-2 placeholder-gray-400 border border-gray-300 rounded-md" id="title" value="{{old('title')}}" placeholder="(必須)">
                        </div>
                    </div>

                    <div class="md:flex items-center">
                        <div class="w-full flex flex-col">
                        <label for="money" class="font-semibold leading-none mt-4 mb-3">金額</label>
                        <input type="text" name="money" class="w-auto py-2 placeholder-gray-400 border border-gray-300 rounded-md" id="money" value="{{old('money')}}" placeholder="￥(必須)">
                        </div>
                    </div>
    
                    <div class="w-full flex flex-col">
                        <label for="body" class="font-semibold leading-none mt-4 mb-3">本文 (思い出)</label>
                        <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md placeholder-gray-400" id="body" cols="30" rows="10" placeholder="(必須)">{{old('body')}}</textarea>
                    </div>
    
                    <div class="w-full flex flex-col">
                        <label for="image" class="font-semibold leading-none mt-4">画像 </label>
                        <div>
                        <input id="image" type="file" name="image">
                        </div>
                    </div>

                    <x-primary-button class="mt-4">
                        投稿する
                    </x-primary-button>
                    
                </form>
            </div>
        </div>
</x-app-layout>
