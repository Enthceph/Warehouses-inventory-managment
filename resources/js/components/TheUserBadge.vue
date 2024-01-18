<script lang="ts" setup>
import {useAuthStore} from "@/js/stores/auth";

const authStore = useAuthStore()

onMounted(() => {
    authStore.getAuthenticatedUser()
})
</script>

<template>
    <div class="badge">
        <router-link class="badge-items" to="/settings">
            <q-avatar color="orange" size="42px">u</q-avatar>
            <div class="user-info">
                <div>{{ authStore.full_name }}</div>
                <div>{{ authStore.email }}</div>
            </div>
        </router-link>
    </div>
</template>

<style scoped>
.badge {
    max-width: 200px;
    padding:   12px;
    width:     100%;
}

.badge-items {
    align-items: center;
    display:     flex;
    gap:         16px;
}

.user-info {
    display:        flex;
    flex-direction: column;
    gap:            -6px;
}
</style>
