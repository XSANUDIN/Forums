<div class="">
    <!-- Post Card 1 -->
    <div class="bg-white p-4 shadow-sm border border-gray-200">
        <div class="flex items-start space-x-4">
            <!-- User Profile Image -->
            <img src="{{ $thread->user->getImageURL()}} " alt="User Avatar" class="rounded-md w-10 h-10">
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <!-- User Name and Time -->

                    <a href="{{ route('users.show',$thread->user->id) }}"><div class="text-sm font-semibold text-gray-800">{{ $thread->user->name }}</div></a>
                    <div class="text-xs text-gray-500">{{ $thread->created_at }}</div>
                    <div class="">
                        <form action="{{route('threads.destroy',$thread->id)}}" method="POST" >
                            @csrf
                            @method('delete')
                            {{-- <a href="{{ route('threads.show',$thread->id)}}">View</a> --}}
                            @auth
                                <a href="{{ route('threads.edit',$thread->id)}}">Edit</a>
                                <button class="bg-red-500 rounded-md px-3 py-2">Delete</button>
                            @endauth
                        </form>
                    </div>

                </div>

                @if ($editing ?? false)
                <div class="bg-white p-4 shadow">
                    <form action="{{ route('threads.update', $thread->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                            <div class="heading text-center font-bold text-2xl m-5 text-gray-800">New Post</div>
                            <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
                                <input name="title" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none" spellcheck="false" placeholder="Title" type="text" value="{{ $thread->title }}">

                                @error('title')
                                    <span class="p-2 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                                <textarea name="content" class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none" spellcheck="false" placeholder="Describe everything about this post here">{{ $thread->content }}</textarea>
                                @error('content')
                                    <span class="p-2 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                                <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:placeholder-gray-400" id="image" type="file">
                                @error('image')
                                    <span class="p-2 text-sm text-red-500">{{ $message }}</span>
                                @enderror

                                <!-- icons -->
                                <div class="icons flex text-gray-500 m-2">
                                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                                <div class="count ml-auto text-gray-400 text-xs font-semibold">0/300</div>
                                </div>

                                <!-- buttons -->
                                <div class="buttons flex">
                                <div type="submit" class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">Cancel</div>
                                <button
                                type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Post</button>
                            </div>
                            </div>
                        </form>
                </div>

                @else
                <!-- Post Title -->
                <a href="{{ route('threads.show',$thread->id)}}">
                    <h2 class="mt-2 text-xl font-semibold text-gray-900">{{ $thread->title }}</h2>
                </a>
                <!-- Post Image -->
                @if ($thread->image)
                    <img src="{{ asset('storage/'.$thread->image) }}" alt="Post Image" class="mt-3 rounded-lg shadow-sm w-full h-auto ">
                @endif

                <!-- Post Content -->
                <p class="mt-3 text-gray-700">{{ $thread->content }}</p>
                @endif


                    <!-- Interaction Buttons (like, comment, etc.) -->
                <div class="mt-3 flex space-x-4 text-gray-600">
                    <button class="flex items-center space-x-1 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                        <span class="text-sm">Upvote {{ $thread->upvote }}</span>
                    </button>
                    <button id="toggleCommentBtn_{{ $thread->id }}" class="flex items-center space-x-1 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                        </svg>
                        <span class="text-sm">Comment {{ 0 }}</span>
                    </button>
                    <button class="flex items-center space-x-1 hover:text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        <span class="text-sm">Share</span>
                    </button>
                </div>
                <!-- Comment Form Row -->
                @include('shared.comments_box')
            </div>
        </div>
    </div>
</div>




