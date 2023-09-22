<script setup>
const route = useRoute()

const onOrgChildPageRegexp = new RegExp(/^\/outlets\/[^\/]+\/[^\/]+$/)

const onChildPagePage = computed(() => {
    return onOrgChildPageRegexp.test(route.fullPath)
})

const nameOfChildPage = computed(() => {
    if (!onChildPagePage.value) return null

    let name = route.fullPath.split('/').pop()
    name = name.charAt(0).toUpperCase() + name.slice(1);
    return name
})


</script>

<template>
    <header class="bg-brown-6">
        <q-breadcrumbs>
            <q-breadcrumbs-el label="Company name" to="/outlets" />
            <q-breadcrumbs-el v-if="route.params.outlet" :label="route.params.outlet"
                :to="'/outlets/' + route.params.outlet" />
            <q-breadcrumbs-el v-if="onChildPagePage" :label="nameOfChildPage" />
        </q-breadcrumbs>

        <router-link to="/settings">
            <q-icon name="settings" />
        </router-link>
    </header>
</template>

<style scoped>
header {
    align-items: center;
    color: var(--va-text-primary);
    display: flex;
    justify-content: space-between;
    padding: 16px;
}
</style>
