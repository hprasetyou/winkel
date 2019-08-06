export default {
    users:{
        title:'User',
        header:[{
            text: 'ID',
            align: 'left',
            value: 'id'
        },
        {
            text: 'Email',
            value: 'email'
        },
        {
            text: 'Name',
            value: 'name'
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
                    label:'Email',
                    model:'email',
                    type:'input'
                },
            ],
            center:[
                {
                    label:'Name',
                    model:'name',
                    type:'input'
                }]
        },
        dataUrl:'/api/user'
    },
    products:{
        title:'Products',
        header:[{
            text: 'ID',
            align: 'left',
            value: 'id'
        },
        {
            text: 'Name',
            value: 'name'
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
                    label:'Name',
                    model:'name',
                    type:'input'
                }
            ]
        },
        dataUrl:'/api/product'
    },
    store:{
        title:'Store',
        header:[{
            text: 'ID',
            align: 'left',
            value: 'id'
        },
        {
            text: 'Name',
            value: 'name'
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
                    label:'Name',
                    model:'name',
                    type:'input'
                }
            ]
        },
        dataUrl:'/api/store'
    },
    sale:{
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
                        text: 'Product',
                        value: 'product.name',
                    },{
                        text: 'Price',
                        value: 'item_price'
                    },{
                        text: 'Qty',
                        value: 'qty',
                        type: 'number',
                        editable: true
                    },{
                        text: 'Total',
                        type: 'method',
                        value: (item)=> item.total = item.qty * item.item_price,
                    }],
                }
            ]
        },
        dataUrl:'/api/sale'
    }
}