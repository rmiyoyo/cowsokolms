<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Create Course</h2>
          
            <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" class="lms-card p-8">
                @csrf
              
                <div class="mb-6">
                    <label class="lms-form-label">Title</label>
                    <input type="text" name="title" required class="lms-form-input">
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">Description</label>
                    <textarea name="description" rows="4" class="lms-form-input"></textarea>
                </div>
                <div class="mb-6">
                    <label class="lms-form-label">Course Image</label>
                    <input type="file" name="image" accept="image/*" class="lms-form-input">
                </div>
                <div class="mb-8">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_published" value="1" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <span class="text-sm font-medium text-gray-700">Publish Course</span>
                    </label>
                </div>
                <button type="submit" class="lms-btn-primary">Create Course</button>
            </form>
        </div>
    </div>
</x-app-layout>