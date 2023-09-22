<script setup lang="ts">
const props = defineProps<{
    title: String,
    address?: String,
    contact_info?: String,
    owner?: String,
}>()

</script>

<template>
    <router-link :to="'outlets/' + title">
        <q-card class="org-card">
            <q-card-section>
                <div class="text-h6 text-center">{{ title }}</div>
            </q-card-section>


            <q-card-section>
                <div class="text-subtitle2">{{ address }}</div>
                <div class="text-subtitle2">{{ contact_info }}</div>
                <div class="text-subtitle2">{{ owner }}</div>
            </q-card-section>
        </q-card>
    </router-link>
</template>

<style scoped>
.org-card {
    transition-duration: 0.3s;
    aspect-ratio: 1 / 1;
    min-width: 172px;
}

.org-card:hover,
.org-card:focus {
    box-shadow: 0 4px 5px -2px rgba(0, 0, 0, 0.2), 0 7px 10px 1px rgba(0, 0, 0, 0.14), 0 2px 16px 1px rgba(0, 0, 0, 0.12);
}
</style>
