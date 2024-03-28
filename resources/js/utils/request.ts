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
                }
            },
        ],
    },
    prefixUrl: `api/`,
})

export default apiRequest
