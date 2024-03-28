<script lang="ts" setup>
import FormWrapper from '@/js/components/Forms/FormWrapper.vue'
import { useProductCategoriesStore } from '@/js/stores/productCategories'
import {
    UpdateProductCategoryForm,
    ProductCategory,
} from '@/js/types/productCategory.types'

const props = defineProps<{
    category: ProductCategory
}>()

const emit = defineEmits(['submitted', 'cancel'])

const loading = ref(false)
const productCategoriesStore = useProductCategoriesStore()

onMounted(() => {
    Object.assign(productCategory, productCategoriesStore.selectedCategory)
})

const productCategory = reactive<UpdateProductCategoryForm>({
    id: props.category.id,
    name: props.category.name,
})

const submit = async () => {
    loading.value = true

    try {
        await productCategoriesStore.fetchUpdateProductCategory(productCategory)
    } catch (err) {
        console.log('UpdateProductCategoryForm Error', err)
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
    <FormWrapper
        :loading="loading"
        action-label="Update"
        title="Update product category"
        @cancel="cancel"
        @submit="submit"
    >
        <q-input
            v-model="productCategory.name"
            :disable="loading"
            :rules="[
                (v) => v.length >= 2 || `Category must have at least 2 letters`,
            ]"
            hide-bottom-space
            label="Name"
            placeholder="Enter category"
            required
        />
    </FormWrapper>
</template>
