<script lang="ts" setup>
import FormWrapper from "@/js/components/Forms/FormWrapper.vue";
import {ProductFormData} from "@/js/types/product.types";
import {useProductsStore} from "@/js/stores/products";
import {useProductCategoriesStore} from "@/js/stores/productCategories";

const emit = defineEmits(['submit', 'cancel'])
const productStore = useProductsStore()
const productCategoriesStore = useProductCategoriesStore()

const loading = ref(false)

onMounted(() => {
    productCategoriesStore.fetchGetProductCategories()
})

// FORM

const form = ref()
const product = reactive<ProductFormData>({
    name: '',
    additional_info: '',
    category_id: null
})

const submit = async () => {
    loading.value = true

    try {
        await productStore.fetchAddProduct(product)
    } catch (err) {
        console.log('AddProductForm Error', err)
        return
    } finally {
        loading.value = false
    }

    emit('submit', product)
}
const cancel = () => {
    emit('cancel')
}
</script>

<template>
    <FormWrapper :loading="loading" action-label="Add" title="Add product" @cancel="cancel" @submit="submit">
        <q-input
            v-model="product.name"
            :disable="loading"
            :rules="[v => v.length >= 2 || `Product name must have at least 2 letters`]"
            hide-bottom-space
            label="Name"
            placeholder="Enter product name"
            required
        />

        <q-input
            v-model="product.additional_info"
            :disable="loading"
            label="Additional info"
            placeholder="Enter additional info"
        />

        <q-select
            v-model="product.category_id"
            :disable="loading || productCategoriesStore.loading"
            :loading="productCategoriesStore.loading"
            :options="productCategoriesStore.categories"
            :rules="[v =>  v || 'Category should be selected']"
            emit-value
            hide-bottom-space
            label="Category"
            map-options
            option-label="name"
            option-value="id"
            options-dense
            required
        />
    </FormWrapper>
</template>
