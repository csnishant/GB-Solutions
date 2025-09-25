<x-app-layout>
    <x-slot name="header">
        <h2 class="flex items-center gap-2 font-bold text-2xl text-white tracking-tight">
            <x-heroicon-o-home class="w-7 h-7 text-blue-400"/>
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10 bg-black min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('posts.create') }}" 
                   class="flex items-center gap-2 bg-[#0A84FF] hover:bg-[#0A6CE3] 
                          text-white font-semibold px-5 py-2.5 
                          rounded-2xl shadow-md shadow-blue-900/50 
                          transition transform hover:scale-105">
                    <x-heroicon-o-plus class="w-5 h-5"/>
                    Add Post
                </a>
                <a href="{{ route('resume.create') }}" 
                   class="flex items-center gap-2 bg-[#30D158] hover:bg-[#28B94C] 
                          text-white font-semibold px-5 py-2.5 
                          rounded-2xl shadow-md shadow-green-900/50 
                          transition transform hover:scale-105">
                    <x-heroicon-o-document-text class="w-5 h-5"/>
                    Create Resume
                </a>
            </div>

            <!-- Posts Section -->
            <div class="bg-[#1C1C1E] rounded-2xl shadow-lg shadow-black/50 p-6">
                <h3 class="flex items-center gap-2 text-xl font-semibold text-white mb-5">
                    <x-heroicon-o-document-text class="w-6 h-6 text-gray-400"/>
                    All Posts
                </h3>

                @forelse($posts as $post)
                    <div class="mb-4 p-5 rounded-2xl bg-[#2C2C2E] 
                                shadow-sm hover:shadow-md hover:bg-[#3A3A3C] 
                                transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="flex items-center gap-2 text-lg font-semibold text-white">
                                    <x-heroicon-o-document-text class="w-5 h-5 text-blue-400"/>
                                    {{ $post->title }}
                                </h4>
                                <p class="text-gray-400 mt-1">
                                    {{ Str::limit($post->content, 60) }}
                                </p>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="{{ route('posts.edit', $post->id) }}" 
                                   class="flex items-center gap-1 text-[#FFD60A] font-medium hover:underline">
                                    <x-heroicon-o-pencil-square class="w-5 h-5"/>
                                    Edit
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this post?')" 
                                            class="flex items-center gap-1 text-[#FF453A] font-medium hover:underline">
                                        <x-heroicon-o-trash class="w-5 h-5"/>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        🚫 No posts found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
