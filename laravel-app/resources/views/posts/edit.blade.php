
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 6px;">Title:</label>
            <input type="text" name="title" value="{{ $post->title }}"
                style="width: 100%; padding: 10px; border: 1px solid #4b5563; border-radius: 4px; background-color: #374151; color: #f3f4f6;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 6px;">Content:</label>
            <textarea name="content" rows="5"
                style="width: 100%; padding: 10px; border: 1px solid #4b5563; border-radius: 4px; background-color: #374151; color: #f3f4f6;">{{ $post->content }}</textarea>
        </div>

        <button type="submit"
            style="background-color: #2563eb; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; margin-right: 10px; cursor: pointer;">
            Update
        </button>

        <a href="{{ route('posts.index') }}"
            style="background-color: #6b7280; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Back
        </a>
    </form>
</div>

