import apiRequest from "../js/utils/request";

export const user = () => apiRequest.get('user')

export const changeName = (data: Object) => apiRequest.patch('changeName', {
    json: data
})

export const changePassword = (data: Object) =>
    apiRequest.patch('changePassword', {
        json: data,
    })
