export default {
    title:'Members',
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
    filterable:[{
        name:'name',
        label:'Name',
        type:'text'
    }],
    formDefinition:{
        left:[
            {
                label:'Name',
                model:'name',
                type:'input'
            },
            {
                label:'Gender',
                model:'gender',
                type:'select',
                items:[
                    {value:'m',text:'Male'},
                    {value:'f',text:'Female'}
                ]
            },
            {
                label:'Address',
                model:'address',
                type:'textarea'
            }
        ]
    },
    dataUrl:'/api/member'
}