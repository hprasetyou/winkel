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
                    disableAdd:true
                },{
                    label: 'Price',
                    type: 'method',
                    value: (item)=> {
                        const api = new apiService();
                        if(item.product.id != item.product_id){
                            api.get(`/api/product/${item.product_id}`).then(res=>{
                                item.product = res.data
                                item.item_price = res.data.price  
                            })
                        }
                        return item.item_price
                    },
                },{
                    label: 'Qty',
                    model: 'qty',
                    type: 'input',
                    editable: true
                },{
                    label: 'Total',
                    type: 'method',
                    value: (item)=> item.total = item.qty * item.item_price,
                }],
            }
        ]
    },
    dataUrl:'/api/sale'
}