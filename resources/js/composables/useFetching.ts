export const useFetching = (callback: Function) => {
    const isFinished = ref(false)
    const statusCode = ref<number | null>(null)
    const response = ref<Response | null>(null)
    const isError = ref(false)
    const error = ref<any>()
    const errors = ref<Object[]>([])
    const data = ref<any>(null)
    const loading = ref(false)

    const fetch = async (...args: any[]) => {
        try {
            isFinished.value = false
            loading.value = true

            const res = await callback(...args)

            // TODO обработку ошибок и response
            statusCode.value = res.status
            data.value = await res.json()
            response.value = res

            return data.value
        } catch (e: any) {
            isError.value = true
            statusCode.value = e.response.status

            const errorResponse = await e.response.json()

            error.value = errorResponse.message
            errors.value = errorResponse.errors
        } finally {
            loading.value = false
            isFinished.value = true
        }
    }

    return {
        fetch: fetch,
        isFinished,
        statusCode,
        response,
        isError,
        error,
        errors,
        data,
        loading
    }
}
