<script lang="ts" setup>

import {useFetching} from "@/js/composables/useFetching";
import {deleteOutlet} from "@/api/outlet";

const {fetch: fetchDelete, data} = useFetching(deleteOutlet)
const router = useRouter()
const route = useRoute()
console.log()
const onDeleteClick = async () => {
    const id = Number(route.params.outlet)

    await fetchDelete(id).then(() => {
        router.push('/organisation')
    })
}

</script>

<template>
    Settings

    <div>
        <q-btn
            color="red"
            @click="onDeleteClick"
        >
            Удалить
        </q-btn>
    </div>
</template>

<style scoped></style>
