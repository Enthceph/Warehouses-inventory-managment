<script lang="ts" setup>
import useApi from "@/js/composables/useApi";
import {useOutletStore} from "@/js/stores/outlet";

const route = useRoute()
const outletStore = useOutletStore()
// const onOrgChildPageRegexp = new RegExp(/^\/outlets\/[^\/]+\/[^\/]+$/)

// const onOutletPage = computed(() => onOrgChildPageRegexp.test(route.fullPath))

const organisation = useApi('getUserOrganisation').get().json()
organisation.onFetchResponse(() => {
    company_name.value = organisation.data.value.title
})
const company_name = ref('')

</script>

<template>

    <header class="bg-brown-6">
        <q-breadcrumbs>
            <q-breadcrumbs-el :label="company_name" to="/organisation"/>

            <q-breadcrumbs-el
                v-if="route.params.outlet"
                :label="outletStore.name"
                :to="'/outlets/' + route.params.outlet"
            />

        </q-breadcrumbs>

        <router-link to="/settings">
            <q-icon name="settings"/>
        </router-link>
    </header>
</template>

<style scoped>
header {
    align-items:     center;
    color:           var(--va-text-primary);
    display:         flex;
    justify-content: space-between;
    padding:         16px;
}
</style>
