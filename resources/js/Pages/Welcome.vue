<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});
</script>

<template>
    <Head title="Mnemodocs" />
    <div
        class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-950 to-black text-white flex flex-col justify-between">
        <!-- Hero Section -->
        <section class="text-center py-24 px-6">
            <h1
                class="text-5xl md:text-6xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-purple-400 via-pink-500 to-red-500">
                Mnemodocs
            </h1>
            <p class="mt-6 text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">
                A personal project built with Laravel, Vue, and Inertia for simple document management and learning modern
                web stacks.
            </p>
    
            <!-- Buttons -->
            <div class="mt-10 flex justify-center gap-4">
                <Link v-if="canLogin" href="/login">
                    <button
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-teal-400 rounded-full text-black font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        Login
                    </button>
                </Link>
                <Link v-if="canRegister" href="/register">
                    <button
                        class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full text-black font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        Register
                    </button>
                </Link>
            </div>
        </section>
    
        <!-- Features Section -->
        <section class="px-6 py-12 bg-gray-950 border-t border-gray-800">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">🚀 Features</h2>
                <p class="text-gray-400 max-w-xl mx-auto">Tools and concepts explored in this project.</p>
            </div>
    
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                <div class="bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition">
                    <h3 class="text-xl font-semibold text-green-400 mb-2">Queue & Jobs</h3>
                    <p class="text-gray-300 text-sm">Background task processing with Laravel Queue & Jobs.</p>
                </div>
                <div class="bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition">
                    <h3 class="text-xl font-semibold text-yellow-400 mb-2">Excel Export</h3>
                    <p class="text-gray-300 text-sm">Easily export structured data to Excel with Laravel Excel.</p>
                </div>
                <div class="bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition">
                    <h3 class="text-xl font-semibold text-pink-400 mb-2">Vue Frontend</h3>
                    <p class="text-gray-300 text-sm">Frontend built with Vue.js for smooth reactive UI experience.</p>
                </div>
                <div class="bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition">
                    <h3 class="text-xl font-semibold text-indigo-400 mb-2">Activity Logs</h3>
                    <p class="text-gray-300 text-sm">Track all user actions using Laravel Audit.</p>
                </div>
            </div>
        </section>
    
        <!-- Footer -->
        <footer class="text-center py-6 text-sm text-gray-500 bg-black border-t border-gray-800">
            Laravel v{{ laravelVersion }} · PHP v{{ phpVersion }} · &copy; 2025 Mnemodocs
        </footer>
    </div>
</template>
