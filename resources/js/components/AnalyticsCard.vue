<script lang="ts" setup>
const props = defineProps<{
    name: string,
    number: string,
    icon: string
}>()
</script>

<template>
    <div class="flex  gap-2 items-start ">
        <div class="flex flex-row  p-6 gap-8 rounded-lg">
            <div class="p-7   round-bg flex-center rounded-full">
                <div class="q-gutter-md">
                    <q-icon
                        :name="props.icon"
                        size="md"
                    />
                </div>
            </div>
            <div class="my-auto">
                <div class="text-lg ">{{ props.name }}</div>
                <div class="text-4xl ">{{ props.number }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped>

.round-bg {
    background-color: white;
}
</style>
