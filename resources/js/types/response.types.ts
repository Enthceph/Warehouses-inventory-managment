export type JSONResponse = Promise<{
    message: string
}>

export type JSONResponseData<T> = Promise<{
    data: T
}>
