<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    project: Object
});

const showAddTaskForm = ref(false);
const editingTask = ref(null);

const addTaskForm = useForm({
    title: '',
    description: '',
    due_date: ''
});

const editTaskForm = useForm({
    title: '',
    description: '',
    due_date: '',
    is_completed: false
});

const submitNewTask = () => {
    addTaskForm.post(route('tasks.store', props.project.id), {
        onSuccess: () => {
            addTaskForm.reset();
            showAddTaskForm.value = false;
        }
    });
};

const startEditTask = (task) => {
    editingTask.value = task.id;
    editTaskForm.title = task.title;
    editTaskForm.description = task.description || '';
    editTaskForm.due_date = task.due_date || '';
    editTaskForm.is_completed = task.is_completed;
};

const cancelEdit = () => {
    editingTask.value = null;
    editTaskForm.reset();
};

const submitEditTask = (taskId) => {
    editTaskForm.put(route('tasks.update', taskId), {
        onSuccess: () => {
            editingTask.value = null;
            editTaskForm.reset();
        }
    });
};

const toggleTaskComplete = (taskId) => {
    router.patch(route('tasks.toggle', taskId));
};

const deleteTask = (taskId) => {
    if (confirm('Are you sure you want to delete this task?')) {
        router.delete(route('tasks.destroy', taskId));
    }
};
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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Add Task Form -->
                <div v-if="showAddTaskForm" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Add New Task</h3>
                        <form @submit.prevent="submitNewTask" class="space-y-4">
                            <div>
                                <InputLabel for="title" value="Task Title" />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="addTaskForm.title"
                                    required
                                    placeholder="e.g., Design homepage mockup"
                                />
                                <InputError class="mt-2" :message="addTaskForm.errors.title" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Description (Optional)" />
                                <textarea
                                    id="description"
                                    v-model="addTaskForm.description"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3"
                                    placeholder="Task details..."
                                ></textarea>
                            </div>

                            <div>
                                <InputLabel for="due_date" value="Due Date (Optional)" />
                                <TextInput
                                    id="due_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="addTaskForm.due_date"
                                />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="addTaskForm.processing">Add Task</PrimaryButton>
                                <button 
                                    type="button" 
                                    @click="showAddTaskForm = false; addTaskForm.reset();"
                                    class="text-gray-600 hover:text-gray-900"
                                >
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tasks List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">
                                Tasks ({{ project.tasks.filter(t => !t.is_completed).length }} / {{ project.tasks.length }})
                            </h3>
                            <button 
                                v-if="!showAddTaskForm"
                                @click="showAddTaskForm = true"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
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
                                class="border rounded-lg p-4 transition"
                                :class="{ 'bg-green-50': task.is_completed, 'hover:bg-gray-50': !task.is_completed }"
                            >
                                <!-- Edit Mode -->
                                <div v-if="editingTask === task.id">
                                    <form @submit.prevent="submitEditTask(task.id)" class="space-y-3">
                                        <div>
                                            <TextInput
                                                type="text"
                                                class="block w-full"
                                                v-model="editTaskForm.title"
                                                required
                                            />
                                        </div>
                                        <div>
                                            <textarea
                                                v-model="editTaskForm.description"
                                                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                rows="2"
                                            ></textarea>
                                        </div>
                                        <div>
                                            <TextInput
                                                type="date"
                                                class="block w-full"
                                                v-model="editTaskForm.due_date"
                                            />
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button 
                                                type="submit"
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm"
                                                :disabled="editTaskForm.processing"
                                            >
                                                Save
                                            </button>
                                            <button 
                                                type="button"
                                                @click="cancelEdit"
                                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded text-sm"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- View Mode -->
                                <div v-else class="flex items-start gap-3">
                                    <input 
                                        type="checkbox" 
                                        :checked="task.is_completed"
                                        @change="toggleTaskComplete(task.id)"
                                        class="mt-1 h-5 w-5 text-blue-600 rounded cursor-pointer"
                                    />
                                    <div class="flex-1">
                                        <h4 class="font-medium" :class="{ 'line-through text-gray-500': task.is_completed }">
                                            {{ task.title }}
                                        </h4>
                                        <p v-if="task.description" class="text-sm text-gray-600 mt-1">
                                            {{ task.description }}
                                        </p>
                                        <p v-if="task.due_date" class="text-xs text-gray-500 mt-2">
                                            📅 Due: {{ new Date(task.due_date).toLocaleDateString() }}
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button 
                                            @click="startEditTask(task)"
                                            class="text-blue-600 hover:text-blue-800 text-sm"
                                        >
                                            Edit
                                        </button>
                                        <button 
                                            @click="deleteTask(task.id)"
                                            class="text-red-600 hover:text-red-800 text-sm"
                                        >
                                            Delete
                                        </button>
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