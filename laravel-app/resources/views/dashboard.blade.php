<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">All Posts</h3>

                <a href="{{ route('posts.create') }}" 
                   class="mb-4 inline-block bg-blue-600 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded">
                    + Add Post
                </a>
                <a href="{{ route('resume.create') }}" 
                    class="mb-4 inline-block bg-green-600 hover:bg-green-800 text-white font-semibold py-2 px-4 rounded">
                    📄 Create a Resume
                </a>

                <!-- Responsive Table Wrapper -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-300 border-collapse">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Title</th>
                                <th class="px-4 py-3">Content</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 border-t">
                            @forelse($posts as $post)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-2">{{ $post->id }}</td>
                                <td class="px-4 py-2">{{ $post->title }}</td>
                                <td class="px-4 py-2">{{ Str::limit($post->content, 50) }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="text-yellow-400 hover:underline">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete this post?')" 
                                                class="text-red-500 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-400">No posts found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- End Responsive Table Wrapper -->

            </div>
        </div>
    </div>
</x-app-layout>
