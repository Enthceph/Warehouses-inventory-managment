export interface AuthUser {
    id: Number
    full_name: string
    email: string
    role: string
    company: string
    created_at: Date | null
}

export type LoginForm = {
    email: AuthUser['email']
    password: string
}

export type LoginResponse = {
    access_token: string
}
