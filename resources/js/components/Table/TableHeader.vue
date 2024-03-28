<script lang="ts" setup>
const props = defineProps({
    names: Array,
    hideActionButtons: Boolean,
})
</script>

<template>
    <thead class="bg-gray-50">
        <tr>
            <th
                v-for="col in props.names"
                class="px-6 py-4 font-medium text-gray-900"
                scope="col"
            >
                {{ col }}
            </th>
            <th v-if="!hideActionButtons"></th>
        </tr>
    </thead>
</template>

<style scoped></style>
