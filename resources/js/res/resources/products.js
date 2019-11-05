export default {
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
        text: 'Price',
        value: 'price'
    },
    {
        text: 'Created At',
        value: 'created_at'
    },
    {
        text: 'Updated At',
        value: 'updated_at'
    }],
    filterable:[{
        name:'name',
        label:'Name',
        type:'text'
    },{
        name:'price',
        label:'Price',
        type:'number'
    }],
    formDefinition:{
        left:[
            {
                label:'Name',
                model:'name',
                type:'input'
            },
            {
                label:'Price',
                model:'price',
                type:'input'
            }
        ],
        right:[
            {
                label:'Product Image',
                model:'mainImage',
                type:'image'
            }
        ]
    },
    dataUrl:'/api/product'
}