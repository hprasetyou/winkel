export default {
    title:'Books',
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
        text: 'ISBN',
        value: 'isbn'
    },
    {
        text: 'Category',
        value: 'category.name',
        sortable: false
    },
    {
        text: 'Author',
        value: 'author.name',
        sortable: false
    },
    {
        text: 'Publisher',
        value: 'publisher.name',
        sortable: false
    }],
    filterable:[{
        name:'name',
        label:'Name',
        type:'text'
    },{
        name:'author',
        label:'Author',
        type:'text'
    },{
        name:'category',
        label:'Category',
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
                label:'Category',
                model:'categories_id',
                type:'one2many',
                objUrl:'category'
            },
            {
                label:'Summary',
                model:'summary',
                type:'textarea'
            },
            {
                label:'Number of copy',
                model:'copy',
                type:'input'
            }
        ],
        center:[
            {
                label:'ISBN',
                model:'isbn',
                type:'input'
            },
            {
                label:'Edition',
                model:'edition',
                type:'input'
            },
            {
                label:'Author',
                model:'author_id',
                type:'one2many',
                objUrl:'author'
            },
            {
                label:'Publisher',
                model:'publisher_id',
                type:'one2many',
                objUrl:'publisher'
            }
        ],
        right:[
            {
                label:'Cover Image',
                model:'cover',
                type:'image'
            }
        ]
    },
    dataUrl:'/api/book'
}