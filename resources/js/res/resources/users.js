export default {
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
}