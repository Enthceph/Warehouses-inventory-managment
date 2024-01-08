<script lang="ts" setup>
import useApi from "@/js/composables/useApi";
import {useOutletStore} from "@/js/stores/outlet";
import {useUserStore} from "@/js/stores/user";
import TheUserBadge from "@/js/components/TheUserBadge.vue";

const route = useRoute()
const outletStore = useOutletStore()

const outletId = route.params.outlet

const organisation = useApi('getUserOrganisation').get().json()
organisation.onFetchResponse(() => {
    company_name.value = organisation.data.value.name
})
const company_name = ref('')

const userStore = useUserStore()

onMounted(() => {
    userStore.fetchUser()
})

</script>

<template>
    <header class="bg-green-700">
        <!--        {{ userStore.full_name }}-->
        <TheUserBadge/>
        <!--        <q-breadcrumbs>-->
        <!--            <q-breadcrumbs-el :label="company_name" to="/organisation"/>-->

        <!--            <q-breadcrumbs-el-->
        <!--                v-if="outletId"-->
        <!--                :label="outletStore.name"-->
        <!--                :to="'/outlet/' + outletId"-->
        <!--            />-->
        <!--        </q-breadcrumbs>-->

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
    padding:         16px 16px 16px 0;
}
</style>
