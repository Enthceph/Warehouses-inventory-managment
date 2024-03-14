import { Role } from '@/js/types/role.types'
import apiRequest from '@/js/utils/request'

export const getRoles = () => apiRequest.get('role').json<Role[]>()
