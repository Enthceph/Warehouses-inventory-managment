import {NavigationGuardNext, RouteLocationNormalized} from "vue-router";

export type Context =  {to: RouteLocationNormalized, from: RouteLocationNormalized, next: NavigationGuardNext}
