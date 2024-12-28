@extends('layout.layout')

@section('content')
<div class="flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <aside class="hidden lg:block lg:w-1/4 bg-white p-4 border-r">
        <div class="sticky top-24">
            <nav class="flex justify-end">
                <ul>
                <li class="mb-4"><a href="#" class="text-lg font-semibold text-gray-700 hover:text-blue-500">Home</a></li>
                <li class="mb-4"><a href="#" class="text-lg font-semibold text-gray-700 hover:text-blue-500">Explore</a></li>
                <li class="mb-4"><a href="#" class="text-lg font-semibold text-gray-700 hover:text-blue-500">Notifications</a></li>
                <li class="mb-4"><a href="#" class="text-lg font-semibold text-gray-700 hover:text-blue-500">Messages</a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 mt-20 p-4">
        @include('shared.thread_card')
    </main>

    <!-- Sider untuk desktop -->
    <aside class="hidden lg:block lg:w-1/4 bg-white p-4 border-l">
      <div class="sticky top-24">
        <h2 class="text-lg font-semibold mb-4">Trending</h2>
        <ul>
          <li class="mb-2 text-gray-700">#TailwindCSS</li>
          <li class="mb-2 text-gray-700">#WebDevelopment</li>
          <li class="mb-2 text-gray-700">#ResponsiveDesign</li>
        </ul>
      </div>
    </aside>
  </div>

@endsection
