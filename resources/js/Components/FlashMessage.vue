<script setup>
import { usePage } from '@inertiajs/vue3';
import NotificationBar from '@/Components/NotificationBar.vue'

const flash = usePage().props.flash;
</script>

<template>
    <div class="mb-5">
        <!-- Flash success message -->
        <NotificationBar v-if="flash.success" color="success">
            <b>Success:</b> {{ flash.success }}
        </NotificationBar>
    
        <!-- Flash error message -->
        <NotificationBar v-if="flash.error" color="error">
            <b>Error:</b> {{ flash.error }}
        </NotificationBar>
    
        <!-- Flash warning message -->
        <NotificationBar v-if="flash.warning" color="warning">
            <b>Warning:</b> {{ flash.warning }}
        </NotificationBar>
    </div>
</template>
  