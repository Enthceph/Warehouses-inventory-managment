export interface AuthUser {
    id: Number
    fullName: string
    email: string
    role: string
    company: string
    created_at: Date | null
}

export type LoginForm = Pick<AuthUser, 'email'> & { password: string }

export type LoginResponse = {
    accessToken: string
}
