<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Add Lesson to {{ $course->title }}</h2>
          
            <form method="POST" action="{{ route('admin.lessons.store', $course) }}" enctype="multipart/form-data" class="lms-card p-8">
                @csrf
              
                <div class="mb-6">
                    <label class="lms-form-label">Title</label>
                    <input type="text" name="title" required class="lms-form-input">
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">Type</label>
                    <select name="type" required class="lms-form-input">
                        <option value="text">Text</option>
                        <option value="image">Image</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">Content</label>
                    <textarea name="content" rows="6" class="lms-form-input"></textarea>
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">File (for image/pdf)</label>
                    <input type="file" name="file" class="lms-form-input">
                </div>
                <div class="mb-8">
                    <label class="lms-form-label">Order</label>
                    <input type="number" name="order" value="0" required class="lms-form-input">
                </div>
                <button type="submit" class="lms-btn-primary">Add Lesson</button>
            </form>
        </div>
    </div>
</x-app-layout>