<script lang="ts" setup>
import {useFetching} from "@/js/composables/useFetching";
import {user} from "@/api/user";
import {useUserStore} from "@/js/stores/user";

const userStore = useUserStore()

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

const {fetch: fetchUser} = useFetching(user)

onBeforeMount(async () => {
    const res = await fetchUser()
    userStore.setUser(res)
})
</script>

<template>
    <component :is="layout">
        <router-view/>
    </component>
</template>
