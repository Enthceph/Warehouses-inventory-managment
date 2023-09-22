import * as auth from '@/api/auth'
import {KyResponse} from "ky";

const apiFunctions = {
    ...auth,
}

type apiKeys = keyof typeof apiFunctions

type ApiResult<T> = {
    isFinished: globalThis.Ref<boolean>
    statusCode: globalThis.Ref<number | null>
    response: globalThis.Ref<Response | null | void>
    isError: globalThis.Ref<boolean>
    error: globalThis.Ref<Error | undefined>
    errors: globalThis.Ref<Error[] | undefined>
    data: globalThis.Ref<any | null>
    isFetching: globalThis.Ref<boolean>
    // immediate: globalThis.Ref<boolean>;
    execute: () => Promise<void>
}
type useApiOptions = {
    immediate?: boolean
    onFetchResponse?: Function
    onFetchError?: Function
}

const  getDataFromResponse = async (response : KyResponse) => {

    const contentType = response.headers.get("Content-Type");

    if(contentType === null){
        throw `Unsupported Content-Type: ${contentType}`
    }
    if (contentType.includes("json")) {
        return await response.json();
    }
    if (contentType.includes("text")) {
        return await response.text();
    }
    if (contentType.includes("application/octet-stream")) {
        return await response.blob();
    }
}

const useApi = <T>(
    api: apiKeys,
    payload?: Object,
    options?: useApiOptions
): ApiResult<T> => {
    const isFinished = ref(false)
    const statusCode = ref<number | null>(null)
    const response = ref<Response | null>(null)
    const isError = ref(false)
    const error = ref<any>()
    const errors = ref<any[]>([])
    const data = ref<any>(null)
    const isFetching = ref(false)
    const immediate = ref(false)

    if (options?.immediate) {
        immediate.value = options.immediate
        execute()
    }

    async function execute(execPayload?: BodyInit) {
        const apiFunction = apiFunctions[api]

        if (!apiFunction) {
            isError.value = true
            error.value = new Error(`API function is not defined.`)
            isFinished.value = true
            isFetching.value = false
            return
        }

        isFinished.value = false
        statusCode.value = null
        response.value = null
        isError.value = false
        error.value = null
        errors.value = []
        data.value = null
        isFetching.value = true

        await apiFunction(
            execPayload || payload || ({} as BodyInit)
        ).then(async res => {
            response.value = res
            statusCode.value = res.status
            data.value = await getDataFromResponse(res)

            if (options?.onFetchResponse) {
                options.onFetchResponse()
            }
        }).catch(async err => {
            let errorResponse = await err.response.json()

            isError.value = true

            response.value = err.response
            statusCode.value = err.response.status
            error.value = errorResponse.message

            if(errorResponse?.errors){
                errors.value = errorResponse.errors
            }

            if (options?.onFetchError) {
                options.onFetchError()
            }
        }).finally(()=>{
            isFinished.value = true
            isFetching.value = false
        })

    }

    return {
        isFinished,
        isFetching,
        statusCode,
        response,
        data,
        isError,
        error,
        errors,
        execute,
    }
}

export default useApi
