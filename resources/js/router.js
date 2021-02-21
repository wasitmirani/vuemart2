import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const folderpath = "./components/dashboard/";
const routes = [{
        path: "/",
        component: require(folderpath + "Home/Home" + "Component.vue").default
    },
    {
        path: "/categories",
        component: require(folderpath + "Category/Category" + "Component.vue")
            .default
    },
    {
        path: "/trashed/categories",
        component: require(folderpath +
            "Category/DeletedCategory" +
            "Component.vue").default
    },
    {
        path: "/sub/categories",
        component: require(folderpath +
            "SubCategory/SubCategory" +
            "Component.vue").default
    },
    {
        path: "/trashed/sub/categories",
        component: require(folderpath +
            "SubCategory/DeletedSubCategory" +
            "Component.vue").default
    },
    {
        path: "/products",
        component: require(folderpath + "Product/Product" + "Component.vue")
            .default
    },
    {
        path: "/orders",
        component: require(folderpath + "Order/Orders" + "Component.vue")
            .default
    },
    {
        path: "/seo/tools",
        component: require(folderpath + "SeoTool/Seo" + "Component.vue")
            .default
    },
    {
        path: "/app/setting",
        component: require(folderpath + "AppSetting/Setting" + "Component.vue")
            .default
    },
    {
        path: "/users",
        component: require(folderpath + "User/Users" + "Component.vue")
            .default
    },
    {
        path: "/roles",
        component: require(folderpath + "Role/Roles" + "Component.vue")
            .default
    },
    {
        path: "/permissions",
        component: require(folderpath + "Permission/Permissions" + "Component.vue")
            .default
    },
    {
        path: "/sale/reports",
        component: require(folderpath + "Reports/Reports" + "Component.vue")
            .default
    },
    {
        path: "/trashed/products",
        component: require(folderpath + "Product/DeletedProducts" + "Component.vue")
            .default
    },
    {
        path: "/app/slider",
        component: require(folderpath + "Slider/Slider" + "Component.vue")
            .default
    },



];

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({

    routes // short for `routes: routes`
});

export default router;