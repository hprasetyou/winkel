import SaleItem from '../components/pages/Sale/Item.vue';
import resConf from '../res/resource-definition';

export default [
    {
        path: `/sale/:id`,
        component: SaleItem,
        meta:resConf.sale
    }
]