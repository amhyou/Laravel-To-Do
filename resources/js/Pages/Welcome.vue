<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Welcome to Todo App" />

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <!-- Navigation -->
        <nav class="container mx-auto px-6 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">T</span>
                    </div>
                    <span class="text-2xl font-bold text-gray-800">TodoApp</span>
                </div>
                
                <div v-if="canLogin" class="flex items-center space-x-4">
                    <Link
                        :href="route('login')"
                        class="text-gray-700 hover:text-blue-600 font-medium transition"
                    >
                        Log in
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-2 rounded-lg font-medium hover:shadow-lg transition transform hover:scale-105"
                    >
                        Get Started
                    </Link>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="container mx-auto px-6 pt-20 pb-32">
            <div class="text-center max-w-4xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center space-x-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-medium mb-8">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <span>Your productivity companion</span>
                </div>

                <!-- Headline -->
                <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Organize Your Projects,
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Accomplish More
                    </span>
                </h1>

                <!-- Subheadline -->
                <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                    A simple and elegant todo app to manage your projects and tasks. 
                    Stay organized, track progress, and achieve your goals effortlessly.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:shadow-2xl transition transform hover:scale-105"
                    >
                        Start For Free
                    </Link>
                    <Link
                        v-if="canLogin"
                        :href="route('login')"
                        class="bg-white text-gray-800 px-8 py-4 rounded-lg font-semibold text-lg border-2 border-gray-200 hover:border-blue-500 transition"
                    >
                        Sign In
                    </Link>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto mt-20">
                    <div>
                        <div class="text-4xl font-bold text-blue-600">100%</div>
                        <div class="text-gray-600 mt-2">Free</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-purple-600">∞</div>
                        <div class="text-gray-600 mt-2">Projects</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-indigo-600">∞</div>
                        <div class="text-gray-600 mt-2">Tasks</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Everything You Need</h2>
                    <p class="text-xl text-gray-600">Simple, powerful features to boost your productivity</p>
                </div>

                <div class="grid md:grid-cols-3 gap-12 max-w-5xl mx-auto">
                    <!-- Feature 1 -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Project Management</h3>
                        <p class="text-gray-600">
                            Organize your work into projects. Create, edit, and manage multiple projects with ease.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Task Tracking</h3>
                        <p class="text-gray-600">
                            Add tasks to your projects, set due dates, and mark them complete as you progress.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Secure & Private</h3>
                        <p class="text-gray-600">
                            Your data is yours. Each user has their own private workspace with secure authentication.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold text-white mb-6">Ready to Get Organized?</h2>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Join thousands of productive people who trust TodoApp to manage their projects.
                </p>
                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:shadow-2xl transition transform hover:scale-105"
                >
                    Create Your Free Account
                </Link>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-12">
            <div class="container mx-auto px-6 text-center">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">T</span>
                    </div>
                    <span class="text-xl font-bold text-white">TodoApp</span>
                </div>
                <p class="text-sm">
                    Built with Laravel, Vue.js, and ❤️
                </p>
                <p class="text-xs mt-4">
                    © 2025 TodoApp. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</template>