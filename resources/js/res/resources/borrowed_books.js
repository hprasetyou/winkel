export default {
    title:'Borrowed Books',
    header:[
    {
        text: 'ID',
        value: 'name'
    },
    {
        text: 'Book',
        value: 'book.name',
        sortable: false
    },
    {
        text: 'Member',
        value: 'member.name',
        sortable: false
    },
    {
        text: 'Status',
        value: 'status',
        sortable: false
    },
    {
        text:'Borrowed at',
        value:'time'
    },{
        text:'Return due date',
        value:'due_date'
    }],
    filterable:[{
        name:'book',
        label:'Book',
        type:'text'
    },{
        name:'member',
        label:'Member',
        type:'text'
    },{
        name:'time',
        label:'Borrow date',
        type:'date'
    },{
        name:'due_date',
        label:'Return due date',
        type:'date'
    },{
        name:'status',
        label:'Status',
        type:'enum',
        options:[{
            text:'Borrowed',
            value:'borrowed'
        },{
            text:'Returned',
            value:'returned'
        },{
            text:'Lost',
            value:'lost'
        }]
    }],
    preFilter:[
        {
            name:'status',
            value:'borrowed',
            operator: '='
        }
    ],
    formDefinition:{
        left:[
            {
                label:'ID',
                model:'name',
                type:'input',
                readOnly:true
            },
            {
                label:'Book',
                model:'book_id',
                type:'one2many',
                itemImage:'cover',
                objUrl:'book'
            },
            {
                label:'Member',
                model:'member_id',
                propToShow:'id-name',
                type:'one2many',
                objUrl:'member',
                disableAdd:true
            },
            {
                label:'Borrowed at',
                model:'time',
                type:'date',
                readOnly:true
            },
            {
                label:'Return due date',
                model:'due_date',
                type:'date',
                readOnly:true
            }
        ],
        center:[
            {
                label:'Status',
                model:'status',
                type:'input',
                readOnly:true
            },
            {
                label:'Returned at',
                model:'returned',
                type:'date',
                readOnly:true
            },
            {
                label:'Remark',
                model:'remark',
                type:'textarea',
                readOnly:true
            }
        ]
    },
    dataUrl:'/api/borrowed_book'
}