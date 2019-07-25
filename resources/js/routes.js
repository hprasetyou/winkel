import ListComponent from './components/html/List.vue';
import DetailComponent from './components/html/Detail.vue';
import resConf from './res/resource-definition';
import salesRoutes from './routes/sales';

let routes = [];

routes = routes.concat(salesRoutes)
for (const key in resConf) {
    if (resConf.hasOwnProperty(key)) {
        const meta = resConf[key]
        meta.baseUrl = `/${key}`
        routes.push({
            path: `/${key}`,
            component: ListComponent,
            meta
        })
        routes.push({
            path: `/${key}/:id`,
            component: DetailComponent,
            meta
        })    
    }
}

export { routes }
