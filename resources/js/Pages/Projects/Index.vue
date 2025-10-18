<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

defineProps({
    projects: Array
});

const deleteProject = (projectId) => {
    if (confirm('Are you sure you want to delete this project? All tasks will be deleted too.')) {
        router.delete(route('projects.destroy', projectId));
    }
};
</script>

<template>
    <Head title="My Projects" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Projects</h2>
                <Link 
                    :href="route('projects.create')" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    + New Project
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="projects.length === 0" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    No projects yet. Create your first project to get started!
                </div>

                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div 
                        v-for="project in projects" 
                        :key="project.id" 
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition"
                    >
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-800">{{ project.name }}</h3>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ project.tasks.length }} tasks
                                </span>
                            </div>
                            
                            <p v-if="project.description" class="text-gray-600 mb-4 line-clamp-2">
                                {{ project.description }}
                            </p>
                            
                            <div class="flex gap-2 mt-4">
                                <Link 
                                    :href="route('projects.show', project.id)" 
                                    class="flex-1 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center text-sm"
                                >
                                    View
                                </Link>
                                <Link 
                                    :href="route('projects.edit', project.id)" 
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm"
                                >
                                    Edit
                                </Link>
                                <button 
                                    @click="deleteProject(project.id)" 
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>