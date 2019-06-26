import ListComponent from './components/html/List.vue';
import FormComponent from './components/html/form/Form.vue';
import resConf from './res/resource-definition';

const routes = [];

for (const key in resConf) {
    if (resConf.hasOwnProperty(key)) {
        routes.push({
            path: `/${key}`,
            component: ListComponent,
            meta:resConf[key]
        })
        routes.push({
            path: `/${key}/:id`,
            component: FormComponent,
            meta:resConf[key]
        })       
    }
}


export { routes }
