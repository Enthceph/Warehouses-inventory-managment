<script lang="ts" setup>

// const userStore = useUserStore()

let layout = computed(() => {
    const {meta} = useRoute();
    const layoutName = meta.layout ?? 'DefaultLayout';
    return defineAsyncComponent(
        () => {
            // @ts-ignore
            return import(`../layouts/${layoutName}.vue`)
        }
    );
})

// const {fetch: fetchUser} = useFetching(user)
//
// onMounted(async () => {
//     const res = await fetchUser()
//     userStore.setUser(res)
// })
</script>

<template>
    <component :is="layout">
        <router-view/>
    </component>
</template>
