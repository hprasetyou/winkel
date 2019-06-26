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
        dataUrl:'/api/product'
    }
}