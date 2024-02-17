<script lang="ts" setup>

import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {AddProductCategoryForm} from "@/js/types/productCategory.types";
import {useProductCategoriesStore} from "@/js/stores/productCategories";

const emit = defineEmits(['submitted', 'cancel'])

const loading = ref(false)

const productCategoriesStore = useProductCategoriesStore()

const productCategory = reactive<AddProductCategoryForm>({
    name: ''
})

const submit = async () => {
    loading.value = true

    try {
        await productCategoriesStore.fetchAddProductCategory(productCategory)
    } catch (err) {
        console.log('AddProductCategoryForm Error', err)
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
        action-label="Add"
        title="Add product category"
        @cancel="cancel"
        @submit="submit"
    >
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
