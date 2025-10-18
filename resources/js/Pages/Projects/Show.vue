<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    project: Object
});
</script>

<template>
    <Head :title="project.name" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ project.name }}</h2>
                    <p v-if="project.description" class="text-sm text-gray-600 mt-1">{{ project.description }}</p>
                </div>
                <Link 
                    :href="route('projects.index')" 
                    class="text-gray-600 hover:text-gray-900"
                >
                    ← Back to Projects
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Tasks</h3>
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                + Add Task
                            </button>
                        </div>

                        <div v-if="project.tasks.length === 0" class="text-center py-8 text-gray-500">
                            No tasks yet. Add your first task to get started!
                        </div>

                        <div v-else class="space-y-3">
                            <div 
                                v-for="task in project.tasks" 
                                :key="task.id"
                                class="border rounded-lg p-4 hover:bg-gray-50 transition"
                            >
                                <div class="flex items-start gap-3">
                                    <input 
                                        type="checkbox" 
                                        :checked="task.is_completed"
                                        class="mt-1 h-5 w-5 text-blue-600 rounded"
                                    />
                                    <div class="flex-1">
                                        <h4 class="font-medium" :class="{ 'line-through text-gray-500': task.is_completed }">
                                            {{ task.title }}
                                        </h4>
                                        <p v-if="task.description" class="text-sm text-gray-600 mt-1">
                                            {{ task.description }}
                                        </p>
                                        <p v-if="task.due_date" class="text-xs text-gray-500 mt-2">
                                            Due: {{ task.due_date }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>