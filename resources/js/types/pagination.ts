export interface Pagination {
    current_page: number
    data: PaginationData[]
    first_page_url: string
    from: number
    last_page: number
    last_page_url: string
    links: Link[]
    next_page_url: string
    path: string
    per_page: number
    prev_page_url: any
    to: number
    total: number
}

export interface PaginationData {
    id: number
    type: 'expense' | 'income'
    amount: number
    date: string
    description: string
    category: string
}

export interface Link {
    url?: string
    label: string
    active: boolean
}
