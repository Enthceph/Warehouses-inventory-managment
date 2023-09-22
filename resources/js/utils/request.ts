import { getBearerToken } from './token'

import ky from 'ky'

const apiRequest = ky.create({
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
    hooks: {
        beforeRequest: [
            request => {
                request.headers.set('Authorization', getBearerToken());
            }
        ]
    },
    prefixUrl: `${import.meta.env.VITE_SERVER_URL}/api/`,
})

export default apiRequest
