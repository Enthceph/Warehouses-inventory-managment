import {getToken} from "@/js/utils/token";
import {createFetch} from '@vueuse/core'

const useApi = createFetch({
    baseUrl: '/api/',
    options: {
        async beforeFetch({options}) {
            // @ts-ignore
            options.headers.Authorization = `Bearer ${getToken()}`

            return {options}
        },
    },
    fetchOptions: {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }
    },
})

export default useApi
