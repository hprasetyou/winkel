import apiService from '../../apiService';
export default {
    title:'Sale',
    header:[{
        text: 'ID',
        align: 'left',
        value: 'id'
    },
    {
        text: 'Total',
        value: 'total'
    },
    {
        text: 'Created At',
        value: 'created_at'
    },
    {
        text: 'Updated At',
        value: 'updated_at'
    }],
    formDefinition:{
        left:[
            {
                label:'ID',
                model:'id',
                type:'input',
                readOnly:true
            }
        ],
        child:[
            {
                label:'Items',
                model:'sales_items',
                header:[{
                    label: 'Product',
                    model: 'product_id',
                    type:'one2many',
                    objUrl:'product',
                    onChange:(val,item)=>{
                        item.product = val;
                        item.item_price = val.price;
                    },
                    disableAdd:true
                },{
                    label: 'Price',
                    type: 'method',
                    reference:['product_id'],
                    value: (refVal,item)=> {                                                
                        return item.item_price
                    },
                },{
                    label: 'Qty',
                    model: 'qty',
                    type: 'input',
                    editable: true,
                    default:1
                },{
                    label: 'Total',
                    type: 'method',
                    reference:['product_id','qty'],
                    value: (refVal,item)=>{
                        item.total = item.qty * item.item_price
                        return !isNaN(item.total)? item.total:0;
                    },
                }],
            }
        ]
    },
    dataUrl:'/api/sale'
}