import { createRouter, createWebHistory } from "vue-router";

// function auth(to, from, next) {
//     if(!localStorage.getItem("API_TOKEN")) {
//         return next({
//             name: "login"
//         })
//     }

//     next();
// }

// function guest(to, from, next) {
//     if(localStorage.getItem("API_TOKEN")) {
//         return next({
//             name: "home"
//         })
//     }

//     next();
// }

import Error404 from "../pages/errors/Error404.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("../pages/Home.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/home",
        redirect: { name: "home" },
    },

    {
        path: "/setting",
        name: "user.setting",
        component: () => import("../pages/user/Setting.vue"),
        meta: { requiresAuth: true },
    },

    {
        path: "/authors",
        name: "authors.index",
        component: () => import("../pages/authors/Index.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/authors/:slug",
        name: "authors.show",
        component: () => import("../pages/authors/Show.vue"),
        meta: { requiresAuth: true },
        props: true,
        // beforeEnter: (to, from, next) => {
        // const itemId = parseInt(to.params.id);
        // if (isNaN(itemId) || !isValidItemId(itemId)) {
        //     next({ name: "NotFound" }); // redirect to 404 page
        // } else {
        //     next();
        // }
        // let isAuthorExist = null;
        // const authors = {};
        // request("get", "/api/authors").then((response) => {
        //     isAuthorExist = response.data.data.find(
        //         (data) => data.slug === to.params.id
        //     );
        // });
        // return isAuthorExist;
        // if (!isAuthorExist) return { name: Error404 }
        // else return next()
        // },
    },
    {
        path: "/authors/create",
        name: "authors.create",
        component: () => import("../pages/authors/Create.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/authors/:slug/edit",
        name: "authors.edit",
        component: () => import("../pages/authors/Edit.vue"),
        meta: { requiresAuth: true },
        props: true,
    },

    {
        path: "/books",
        name: "books.index",
        component: () => import("../pages/books/Index.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/books/show",
        name: "books.show",
        component: () => import("../pages/books/Show.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/books/create",
        name: "books.create",
        component: () => import("../pages/books/Create.vue"),
        meta: { requiresAuth: true },
    },

    {
        path: "/genres",
        name: "genres.index",
        component: () => import("../pages/genres/Index.vue"),
        meta: { requiresAuth: true },
    },
    {
        path: "/genres/show",
        name: "genres.show",
        component: () => import("../pages/genres/Show.vue"),
        meta: { requiresAuth: true },
    },

    {
        path: "/login",
        name: "login",
        component: () => import("../pages/auth/Login.vue"),
    },
    {
        path: "/register",
        name: "register",
        component: () => import("../pages/auth/Register.vue"),
    },
    {
        path: "/forget-password",
        name: "forget-password",
        component: () => import("../pages/auth/ForgetPassword.vue"),
    },

    {
        // path: "/:catchAll(.*)",
        path: "/:pathMatch(.*)*",
        component: Error404,
        name: "Error404",
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes, // short for `routes: routes`
    linkActiveClass: "text-light-brown",
});

// Authorization

// let isAuthenticated = Boolean(localStorage.getItem('API_TOKEN'))
function isAuthenticated() {
    return Boolean(localStorage.getItem("API_TOKEN"));
}

router.beforeEach((to, from, next) => {
    const token = Boolean(localStorage.getItem("API_TOKEN"));

    if (to.matched.some((record) => record.meta.requiresAuth)) {
        // Route requires authentication
        if (!token) {
            next({ name: "login" });
        } else {
            next();
        }
    } else {
        // Route does not require authentication
        if (token && (to.name == "login" || to.name == "register")) {
            next({ name: "home" });
        } else {
            next();
        }
    }
});

export default router;
