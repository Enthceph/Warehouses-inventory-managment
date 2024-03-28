<script lang="ts" setup>
const props = defineProps<{
    link: string
    icon: string
    label: string
}>()
</script>

<template>
    <router-link :to="`/${props.link}`">
        <q-item class="flex gap-5 items-center" clickable>
            <q-icon :name="props.icon" />
            <div>{{ props.label }}</div>
        </q-item>
    </router-link>
</template>
<style scoped>
.router-link-exact-active {
    color: #1c77fb;
}

.router-link-exact-active > .q-item {
    background-color: rgb(223 236 255);
}
</style>
