export const getBearerToken = (): string => {
    return "Bearer " + localStorage.getItem('access_token')
}

export const getToken = (): string | null => {
    return localStorage.getItem('access_token')
}

export const setToken = (token: string): void => {
    localStorage.setItem('access_token', token)
}

export const deleteToken = () => {
    localStorage.removeItem('access_token')
}
