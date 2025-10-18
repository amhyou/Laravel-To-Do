<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    projects: Array,
    stats: Object
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-600 text-sm">Total Projects</div>
                        <div class="text-3xl font-bold text-blue-600">{{ stats.total_projects }}</div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-600 text-sm">Total Tasks</div>
                        <div class="text-3xl font-bold text-green-600">{{ stats.total_tasks }}</div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="text-gray-600 text-sm">Completed Tasks</div>
                        <div class="text-3xl font-bold text-purple-600">{{ stats.completed_tasks }}</div>
                    </div>
                </div>

                <!-- Recent Projects -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Recent Projects</h3>
                            <Link 
                                :href="route('projects.index')" 
                                class="text-blue-600 hover:text-blue-800 text-sm"
                            >
                                View All →
                            </Link>
                        </div>

                        <div v-if="projects.length === 0" class="text-center py-8 text-gray-500">
                            No projects yet. 
                            <Link :href="route('projects.create')" class="text-blue-600 hover:underline">
                                Create your first project
                            </Link>
                        </div>

                        <div v-else class="space-y-3">
                            <Link 
                                v-for="project in projects" 
                                :key="project.id"
                                :href="route('projects.show', project.id)"
                                class="block border rounded-lg p-4 hover:bg-gray-50 transition"
                            >
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-medium text-gray-800">{{ project.name }}</h4>
                                        <p v-if="project.description" class="text-sm text-gray-600 mt-1">
                                            {{ project.description }}
                                        </p>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                        {{ project.tasks.length }} tasks
                                    </span>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>