<script lang="ts" setup>
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {useProductCategoriesStore} from "@/js/stores/productCategories";
import {ProductCategoryFormData} from "@/js/types/productCategory.types";

const emit = defineEmits(['submitted', 'cancel'])

const loading = ref(false)
const productCategoriesStore = useProductCategoriesStore()
// FORM

const productCategory = reactive<ProductCategoryFormData>({
    name: productCategoriesStore?.selectedCategory?.name
})

const submit = async () => {
    loading.value = true

    try {
        if (productCategoriesStore.selectedCategory) {
            await productCategoriesStore.fetchUpdateProductCategory(productCategoriesStore.selectedCategory.id, productCategory)
        }
    } catch (err) {
        console.log('EditProductCategoryForm Error', err)
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
    <FormWrapper :loading="loading" action-label="Edit" title="Edit product category" @cancel="cancel" @submit="submit">
        <q-input
            v-model="productCategory.name"
            :disable="loading"
            :rules="[v => v.length >= 2 || `Category must have at least 2 letters`]"
            hide-bottom-space
            label="Name"
            placeholder="Enter category"
            required
        />
    </FormWrapper>
</template>

<style scoped>

</style>
