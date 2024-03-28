import { Context } from '@/js/types/router.types'

const middlewarePipeline = (
    context: Context,
    middleware: Function[],
    index: number
) => {
    const nextMiddleware = middleware[index]

    if (!nextMiddleware) {
        return context.next
    }

    return () => {
        const nextPipeline = middlewarePipeline(context, middleware, index + 1)

        nextMiddleware({ ...context, next: nextPipeline })
    }
}

export default middlewarePipeline
