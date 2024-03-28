import { getBearerToken } from './token'
import { Notify } from 'quasar'
import ky from 'ky'

const apiRequest = ky.create({
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
    hooks: {
        beforeRequest: [
            (request) => {
                request.headers.set('Authorization', getBearerToken())
            },
        ],
        afterResponse: [
            async (request, options, response) => {
                if (
                    response.headers
                        .get('Content-Type')
                        ?.includes('application/json')
                ) {
                    let res = await response.clone().json()

                    if (!response.ok) {
                        Notify.create({
                            type: 'error',
                            message: res.message,
                        })
                    }

                    return res
                } else {
                    console.error('Non-JSON response received')
                    throw new Error('Non-JSON response received')
                }
            },
        ],
    },
    // ${import.meta.env.VITE_SERVER_URL}/
    prefixUrl: `api/`,
})

export default apiRequest
