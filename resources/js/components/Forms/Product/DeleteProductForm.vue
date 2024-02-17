<script lang="ts" setup>
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {useProductsStore} from "@/js/stores/products";
import {Product} from "@/js/types/product.types";

const emit = defineEmits(['submit', 'cancel'])

const loading = ref(false)
const productStore = useProductsStore()

const props = defineProps<{
    product: Product
}>()

const submit = async () => {
    loading.value = true

    try {
        await productStore.fetchDeleteProduct(props.product.id)
    } catch (err) {
        console.log('DeleteProductForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit')
}
const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Delete" title="Delete product" @cancel="cancel" @submit="submit">
        Do you really wish to delete product <b>{{ props.product.name }}</b> ?
    </FormWrapper>
</template>
