<script lang="ts" setup>
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {useProductCategoriesStore} from "@/js/stores/productCategories";
import {ProductCategory} from "@/js/types/productCategory.types";

const props = defineProps<{
    category: ProductCategory
}>()

const emit = defineEmits(['submitted', 'cancel'])

const loading = ref(false)

const productCategoriesStore = useProductCategoriesStore()

const submit = async () => {
    loading.value = true

    try {
        await productCategoriesStore.fetchDeleteProductCategory(props.category.id)
    } catch (err) {
        console.log('DeleteProductCategoryForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submitted')
}
const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Delete" title="" @cancel="cancel" @submit="submit">
        Do you really want ot delete product category <b>{{ props.category.name }}</b>?
    </FormWrapper>
</template>
