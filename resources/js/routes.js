import ListComponent from './components/html/List.vue';
import FormComponent from './components/html/form/Form.vue';
import resConf from './res/resource-definition';

const routes = [];

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
            component: FormComponent,
            meta
        })    
    }
}


export { routes }
