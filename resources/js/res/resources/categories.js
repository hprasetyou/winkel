export default {
    title:'Categories',
    header:[{
        text: 'ID',
        align: 'left',
        value: 'id'
    },
    {
        text: 'Name',
        value: 'name'
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
            }
        ]
    },
    dataUrl:'/api/category'
}